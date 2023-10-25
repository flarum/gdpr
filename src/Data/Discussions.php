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

use Flarum\Discussion\Discussion;
use Illuminate\Support\Arr;
use PhpZip\ZipFile;

class Discussions extends Type
{
    public static function exportDescription(): string
    {
        return 'Exports all discussions the user has started. Data restricted to title and creation date.';
    }
    
    public function export(ZipFile $zip): void
    {
        Discussion::query()
            ->where('user_id', $this->user->id)
            ->whereVisibleTo($this->user)
            ->orderBy('created_at', 'asc')
            ->each(function (Discussion $discussion) use ($zip) {
                $zip->addFromString(
                    "discussions/discussion-{$discussion->id}.json",
                    $this->encodeForExport($this->sanitize($discussion))
                );
            });
    }

    protected function sanitize(Discussion $discussion): array
    {
        return Arr::only($discussion->toArray(), [
            'title', 'created_at',
        ]);
    }

    public static function anonymizeDescription(): string
    {
        return self::NO_ACTION_TAKEN;
    }

    public function anonymize(): void
    {
        // Nothing to do
    }

    public static function deleteDescription(): string
    {
        return self::NO_ACTION_TAKEN;
    }

    public function delete(): void
    {
        // Nothing to do
    }
}
