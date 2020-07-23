<?php

namespace Bokt\Gdpr\Data;

use Bokt\Gdpr\Contracts\DataType;
use Flarum\Post\Post;
use Flarum\User\User;
use ZipArchive;

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

    public function export(ZipArchive $zip)
    {
        Post::query()
            ->where('user_id', $this->user->id)
            ->each(function (Post $post) use ($zip) {
                $zip->addFromString(
                    "post-{$post->id}.json",
                    $post->toJson(JSON_PRETTY_PRINT)
                );
            });
    }
}
