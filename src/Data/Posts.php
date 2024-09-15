<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Data;

use Flarum\Post\Post;
use Illuminate\Support\Arr;

class Posts extends Type
{
    public function export(): ?array
    {
        $exportData = [];

        Post::query()
            ->where('user_id', $this->user->id)
            ->where('type', 'comment')
            ->where('is_private', false) // We don't export posts marked as private, extensions which handle the private flag must export as neccessary
            ->whereVisibleTo($this->user)
            ->orderBy('created_at', 'asc')
            ->each(function (Post $post) use (&$exportData) {
                $exportData[] = ["posts/post-{$post->id}.json" => $this->encodeForExport($this->sanitize($post))];
            });

        return $exportData;
    }

    protected function sanitize(Post $post): array
    {
        return Arr::only($post->toArray(), [
            'content', 'created_at',
            'ip_address', 'discussion_id',
        ]);
    }

    public function anonymize(): void
    {
        Post::query()
            ->where('user_id', $this->user->id)
            ->update(['ip_address' => null]);
    }

    public function delete(): void
    {
        Post::query()->where('user_id', $this->user->id)->delete();
    }
}
