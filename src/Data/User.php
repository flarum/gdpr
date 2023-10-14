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

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PhpZip\ZipFile;

class User extends Type
{
    public function export(ZipFile $zip): void
    {
        $remove = ['id', 'password', 'groups'];

        $zip->addFromString(
            'user.json',
            json_encode(Arr::except($this->user->toArray(), $remove), JSON_PRETTY_PRINT)
        );
    }

    public function anonymize(): void
    {
        $columns = $this->getTableColumns($this->user);

        $remove = ['id', 'username', 'password', 'email', 'is_email_confirmed', 'preferences', 'joined_at'];

        foreach ($columns as $column) {
            if (in_array($column, $remove)) {
                continue;
            }

            $this->user->{$column} = null;
        }

        $this->user->username = "Anonymous#{$this->erasureRequest->id}";
        $this->user->email = "{$this->user->username}@flarum-gdpr.local";
        $this->user->is_email_confirmed = false;
        $this->user->setPasswordAttribute(Str::random(40));
        $this->user->setPreferencesAttribute([]);
        $this->user->joined_at = Carbon::now();

        $this->user->save();
    }

    public function delete(): void
    {
        $this->user->delete();
    }
}
