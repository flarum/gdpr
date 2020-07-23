<?php

namespace Bokt\Gdpr\Contracts;

use Flarum\User\User;
use ZipArchive;

interface DataType
{
    public function __construct(User $user);

    public function export(ZipArchive $zip);
}
