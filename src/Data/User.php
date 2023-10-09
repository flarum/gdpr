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

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PhpZip\ZipFile;

class User extends Type
{
    public function export(ZipFile $zip): void
    {
        $remove = ['id', 'password'];

        $zip->addFromString(
            'user.json',
            json_encode(Arr::except($this->user->toArray(), $remove))
        );
    }

    public function anonymize(): void
    {
        $columns = $this->schema->getColumnListing($this->user->getTable());

        $remove = ['id', 'username', 'password', 'email', 'is_email_confirmed', 'preferences'];

        foreach ($columns as $column) {
            if (in_array($column, $remove)) {
                continue;
            }

            $this->user->{$column} = null;
        }

        $this->user->username = Str::random(40);
        $this->user->email = "{$this->user->username}@flarum-gdpr.local";
        $this->user->is_email_confirmed = false;
        $this->user->setPasswordAttribute(Str::random(40));
        $this->user->preferences = [];

        $this->user->save();
    }

    public function delete(): void
    {
        $this->user->delete();
    }
}
