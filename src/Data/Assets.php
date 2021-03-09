<?php

namespace Blomstra\Gdpr\Data;

use Blomstra\Gdpr\Contracts\DataType;
use Flarum\User\User;
use Illuminate\Support\Str;
use ZipArchive;

class Assets implements DataType
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
        if ($this->user->avatar_url) {
            $fileType  = Str::afterLast($this->user->avatar_url, '.');
            $zip->addFile(
                $this->user->avatar_url,
                "avatar.$fileType"
            );
        }
    }
}
