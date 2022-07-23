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

use Blomstra\Gdpr\Contracts\DataType;
use Flarum\Post\Post;
use Flarum\User\User;
use Illuminate\Support\Arr;
use PhpZip\ZipFile;

class Posts implements DataType
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function export(ZipFile $zip)
    {
        Post::query()
            ->where('user_id', $this->user->id)
            ->each(function (Post $post) use ($zip) {
                $zip->addFromString(
                    "post-{$post->id}.json",
                    json_encode(
                        $this->sanitize($post),
                        JSON_PRETTY_PRINT
                    )
                );
            });
    }

    protected function sanitize(Post $post)
    {
        return Arr::only($post->toArray(), [
            'content', 'created_at',
            'ip_address',
        ]);
    }
}
