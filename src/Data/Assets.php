<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Data;

use Illuminate\Support\Str;
use PhpZip\ZipFile;

class Assets extends Type
{
    public static function dataType(): string
    {
        return 'Avatar';
    }

    public static function exportDescription(): string
    {
        return "Retrieves the user's avatar from the filesystem and includes it in the export.";
    }

    public function export(ZipFile $zip): void
    {
        if ($this->user->avatar_url) {
            $fileName = $this->getAvatarFileName();
            $fileType = Str::afterLast($fileName, '.');

            $filesystem = $this->getDisk('flarum-avatars');

            if ($filesystem->exists($fileName)) {
                $file = $filesystem->get($fileName);

                $zip->addFromString(
                    "avatar.$fileType",
                    $file
                );
            }
        }
    }

    public static function anonymizeDescription(): string
    {
        return self::deleteDescription();
    }

    public function anonymize(): void
    {
        // Anonymization isn't really possible with avatars, just delete 'em.
        $this->delete();
    }

    public static function deleteDescription(): string
    {
        return "Deletes the user's avatar from the filesystem.";
    }

    public function delete(): void
    {
        if ($this->user->avatar_url) {
            $filesystem = $this->getDisk('flarum-avatars');
            $fileName = $this->getAvatarFileName();

            $filesystem->exists($fileName) && $filesystem->delete($fileName);
        }
    }

    private function getAvatarFileName(): string
    {
        return Str::afterLast($this->user->avatar_url, '/');
    }
}
