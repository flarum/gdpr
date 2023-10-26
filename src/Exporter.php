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
use Flarum\Notification\Notification;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use Illuminate\Contracts\Filesystem\Factory;
use PhpZip\ZipFile;
use Symfony\Contracts\Translation\TranslatorInterface;

class Exporter
{
    protected string $storagePath;

    public function __construct(
        Paths $paths,
        protected SettingsRepositoryInterface $settings,
        protected DataProcessor $processor,
        protected Factory $factory,
        protected UrlGenerator $url,
        protected TranslatorInterface $translator,
        protected StorageManager $storageManager
    ) {
        $this->storagePath = $paths->storage;
    }

    public function export(User $user, User $actor): Export
    {
        $tmpDir = $this->getTempDir();

        $file = tempnam($tmpDir, 'gdpr-export-'.$user->username);

        $zip = new ZipFile();

        foreach ($this->processor->removableUserColumns() as $column) {
            if ($user->{$column} !== null) {
                $user->{$column} = null;
            }
        }

        foreach ($this->processor->types() as $type => $extension) {
            /** @var DataType $segment */
            $segment = new $type($user, null, $this->factory, $this->settings, $this->url, $this->translator);

            $segment->export($zip);
        }

        $zip->saveAsFile($file);
        $zip->close();

        $export = Export::exported($user, basename($file), $actor);

        $this->storageManager->storeExport($export, $file);

        unlink($file);

        return $export;
    }

    public function destroy(Export $export)
    {
        $this->storageManager->deleteStoredExport($export);

        Notification::query()
            ->where('type', 'gdprExportAvailable')
            ->where('subject_id', $export->id)
            ->update(['is_deleted' => true]);

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
