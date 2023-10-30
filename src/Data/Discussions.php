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

class Discussions extends Type
{
    public function export(): ?array
    {
        $exportData = [];
        
        Discussion::query()
            ->where('user_id', $this->user->id)
            ->whereVisibleTo($this->user)
            ->orderBy('created_at', 'asc')
            ->each(function (Discussion $discussion) use (&$exportData) {
                $exportData[] = ["discussions/discussion-{$discussion->id}.json" => $this->encodeForExport($this->sanitize($discussion))];
            });

        return $exportData;
    }

    protected function sanitize(Discussion $discussion): array
    {
        return Arr::only($discussion->toArray(), [
            'title', 'created_at',
        ]);
    }

    public static function anonymizeDescription(): string
    {
        return self::deleteDescription();
    }

    public function anonymize(): void
    {
        // Nothing to do
    }

    public static function deleteDescription(): string
    {
        return static::staticTranslator()->trans('blomstra-gdpr.lib.data.no_action');
    }

    public function delete(): void
    {
        // Nothing to do
    }
}
