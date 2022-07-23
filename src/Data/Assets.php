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
use Flarum\User\User;
use Illuminate\Support\Str;
use PhpZip\ZipFile;

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

    public function export(ZipFile $zip)
    {
        if ($this->user->avatar_url) {
            $fileType = Str::afterLast($this->user->avatar_url, '.');

            $stream = fopen($this->user->avatar_url, 'r');

            $zip->addFromStream(
                $stream,
                "avatar.$fileType"
            );

            fclose($stream);
        }
    }
}
