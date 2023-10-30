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

class User extends Type
{
    public function export(): ?array
    {
        $remove = ['id', 'password', 'groups'];

        return ['user.json' => $this->encodeForExport(
            Arr::except($this->user->toArray(), $remove)
        )];
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

    public function delete(): void
    {
        $this->user->delete();
    }
}
