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
    public function export(ZipFile $zip): void
    {
        Discussion::query()
            ->where('user_id', $this->user->id)
            ->whereVisibleTo($this->user)
            ->orderBy('created_at', 'asc')
            ->each(function (Discussion $discussion) use ($zip) {
                $zip->addFromString(
                    "discussions/discussion-{$discussion->id}.json",
                    json_encode(
                        $this->sanitize($discussion),
                        JSON_PRETTY_PRINT
                    )
                );
            });
    }

    protected function sanitize(Discussion $discussion): array
    {
        return Arr::only($discussion->toArray(), [
            'title', 'created_at',
        ]);
    }

    public function anonymize(): void
    {
        // Nothing to do
    }

    public function delete(): void
    {
        // Be careful here, do we really want to delete a whole discussion? TODO: discuss...
        Discussion::query()->where('user_id', $this->user->id)->delete();
    }
}
