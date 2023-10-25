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
    public static function exportDescription(): string
    {
        return 'Exports all posts the user has made. Data restricted to content, creation date, IP address and discussion ID.';
    }
    
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
                    $this->encodeForExport($this->sanitize($post))
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

    public static function anonymizeDescription(): string
    {
        return 'Removes the IP address from all posts the user has made.';
    }

    public function anonymize(): void
    {
        Post::query()
            ->where('user_id', $this->user->id)
            ->update(['ip_address' => null]);
    }

    public static function deleteDescription(): string
    {
        return 'Deletes all posts the user has made.';
    }

    public function delete(): void
    {
        Post::query()->where('user_id', $this->user->id)->delete();
    }
}
