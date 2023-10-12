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
use Flarum\Foundation\Paths;
use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Contracts\Filesystem\Filesystem;
use Laminas\Diactoros\Response;
use PhpZip\ZipFile;
use Symfony\Contracts\Translation\TranslatorInterface;

class Exporter
{
    protected string $storagePath;
    protected array $types;
    protected Filesystem $filesystem;

    public function __construct(
        Paths $paths, 
        protected SettingsRepositoryInterface $settings, 
        protected DataProcessor $processor, 
        protected Factory $factory, 
        protected UrlGenerator $url, 
        protected TranslatorInterface $translator
    )
    {
        $this->storagePath = $paths->storage;
        $this->filesystem = $factory->disk('gdpr-export');
    }

    public function export(User $user): Export
    {
        $tmpDir = $this->getTempDir();
        
        $file = tempnam($tmpDir, 'gdpr-export-'.$user->username);

        $zip = new ZipFile();

        foreach ($this->processor->removableUserColumns() as $column) {
            if ($user->{$column} !== null) {
                $user->{$column} = null;
            }
        }

        foreach ($this->processor->types() as $type) {
            /** @var DataType $segment */
            $segment = new $type($user, $this->factory, $this->settings, $this->url, $this->translator);

            $segment->export($zip);
        }

        $zip->saveAsFile($file);
        $zip->close();

        $export = Export::exported($user, basename($file));

        if ($this->filesystem->exists($export->id)) {
            $this->filesystem->delete($export->id);
        }

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

    private function getTempDir(): string
    {
        $tmpDir = $this->storagePath.DIRECTORY_SEPARATOR.'tmp';
        if (!is_dir($tmpDir)) {
            mkdir($tmpDir, 0777, true);
        }

        return $tmpDir;
    }
}
