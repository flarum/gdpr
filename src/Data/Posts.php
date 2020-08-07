<?php

namespace Bokt\Gdpr\Data;

use Bokt\Gdpr\Contracts\DataType;
use Flarum\Post\Post;
use Flarum\User\User;
use Illuminate\Support\Arr;
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
            'ip_address'
        ]);
    }
}
