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

use Flarum\Post\Post;
use Illuminate\Support\Arr;
use PhpZip\ZipFile;

class Posts extends Type
{
    public function export(ZipFile $zip): void
    {
        Post::query()
            ->where('user_id', $this->user->id)
            ->where('type', 'comment')
            ->whereVisibleTo($this->user)
            ->orderBy('created_at', 'asc')
            ->each(function (Post $post) use ($zip) {
                $zip->addFromString(
                    "posts/post-{$post->id}.json",
                    json_encode(
                        $this->sanitize($post),
                        JSON_PRETTY_PRINT
                    )
                );
            });
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
