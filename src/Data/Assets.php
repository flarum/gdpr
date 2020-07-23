<?php

namespace Bokt\Gdpr\Data;

use Bokt\Gdpr\Contracts\DataType;
use Flarum\User\User;
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
            $zip->addFile($this->user->avatar_url);
        }
    }
}
