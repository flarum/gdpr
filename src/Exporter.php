<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr;

use Blomstra\Gdpr\Contracts\DataType;
use Blomstra\Gdpr\Models\Export;
use Carbon\Carbon;
use Flarum\Foundation\Paths;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use Illuminate\Contracts\Filesystem\Filesystem;
use Laminas\Diactoros\Response;
use PhpZip\ZipFile;

class Exporter
{
    protected string $storagePath;
    protected array $types;

    public function __construct(protected Filesystem $filesystem, Paths $paths, protected SettingsRepositoryInterface $settings, DataProcessor $processor)
    {
        $this->storagePath = $paths->storage;
        $this->types = $processor->types();
    }

    public function export(User $user): Export
    {
        $file = tempnam($this->storagePath.DIRECTORY_SEPARATOR.'tmp', 'gdpr-export-'.$user->username);

        $zip = new ZipFile();
        $now = Carbon::now();

        $zip->setArchiveComment("Export of user data for $user->username ($user->email) on $now. From: {$this->settings->get('forum_title')}.");

        foreach ($this->types as $type) {
            /** @var DataType $segment */
            $segment = new $type($user);

            $segment->export($zip);
        }

        $zip->saveAsFile($file);
        $zip->close();

        if ($this->filesystem->exists($user->id)) {
            $this->filesystem->delete($user->id);
        }

        $export = Export::exported($user, basename($file));

        $this->filesystem->writeStream($export->id, $handle = fopen($file, 'r'));

        fclose($handle);

        unlink($file);

        return $export;
    }

    public function getZip(Export $export)
    {
        return new Response(
            $this->filesystem->readStream($export->id),
            200,
            [
                'Content-Type'        => 'application/zip',
                'Content-Length'      => $this->filesystem->size($export->id),
                'Content-Disposition' => 'attachment; filename="gdpr-data-'.$export->user->username.'-'.$export->created_at->toIso8601String().'.zip"',
            ]
        );
    }

    public function destroy(Export $export)
    {
        $this->filesystem->delete($export->id);

        $export->delete();
    }
}
