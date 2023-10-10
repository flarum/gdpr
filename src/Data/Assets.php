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

use Flarum\Filesystem\FilesystemManager;
use Flarum\User\User;
use Illuminate\Support\Str;
use PhpZip\ZipFile;

class Assets extends Type
{
    public function export(ZipFile $zip): void
    {
        if ($this->user->avatar_url) {
            $fileType = Str::afterLast($this->user->avatar_url, '.');

            $stream = fopen($this->user->avatar_url, 'r');

            $zip->addFromStream(
                $stream,
                "avatar.$fileType"
            );

            fclose($stream);
        }
    }

    public function anonymize(): void
    {
        // Anonymization isn't really possible with avatars, just delete 'em.
        $this->delete();
    }

    public function delete(): void
    {
        if ($path = $this->user->avatar_url) {
            /** @var FilesystemManager $fs */
            $fs = resolve(FilesystemManager::class);
            $filesystem = $fs->disk('flarum-avatars');

            $filesystem->exists($path) && $filesystem->delete($path);
        }
    }
}
