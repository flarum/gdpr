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
    public static function exportDescription(): string
    {
        return 'Exports data from the user table. All columns except id, password.';
    }

    public function export(ZipFile $zip): void
    {
        $remove = ['id', 'password', 'groups'];

        $zip->addFromString(
            'user.json',
            $this->encodeForExport(
                Arr::except($this->user->toArray(), $remove)
            )
        );
    }

    public static function anonymizeDescription(): string
    {
        return 'Sets all columns on the user table to null. Non-nullable columns are set to their default values or special values. Password is changed, preferences set to default and all groups are removed.';
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

        $this->user->rename("Anonymous{$this->erasureRequest->id}");
        $this->user->changeEmail("{$this->user->username}@flarum-gdpr.local");
        $this->user->is_email_confirmed = false;
        $this->user->setPasswordAttribute(Str::random(40));
        $this->user->setPreferencesAttribute([]);
        $this->user->joined_at = Carbon::now();
        $this->user->groups()->sync([]);

        $this->user->save();
    }

    public static function deleteDescription(): string
    {
        return 'Deletes the user from the database.';
    }

    public function delete(): void
    {
        $this->user->delete();
    }
}
