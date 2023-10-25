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

use Flarum\Api\ApiKey;
use Flarum\Http\AccessToken;
use Flarum\User\EmailToken;
use Flarum\User\LoginProvider;
use Flarum\User\PasswordToken;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PhpZip\ZipFile;

class Tokens extends Type
{
    protected array $classes = [
        ApiKey::class,
        AccessToken::class,
        EmailToken::class,
        LoginProvider::class,
        PasswordToken::class,
    ];

    public static function exportDescription(): string
    {
        return 'Exports all tokens the user has created. Data restricted to creation date and token type.';
    }
    
    public function export(ZipFile $zip): void
    {
        foreach ($this->classes as $class) {
            $baseName = Str::afterLast($class, '\\');

            $class::query()
                ->where('user_id', $this->user->id)
                ->each(function ($token) use ($zip, $baseName) {
                    $id = $token->getKey();
                    $zip->addFromString(
                        "tokens/token-$baseName-$id.json",
                        json_encode(Arr::except($token->toArray(), ['user_id', 'token', 'key']), JSON_PRETTY_PRINT)
                    );
                });
        }
    }

    public static function anonymizeDescription(): string
    {
        return self::deleteDescription();
    }

    public function anonymize(): void
    {
        $this->delete();
    }

    public static function deleteDescription(): string
    {
        return 'Deletes all tokens the user has created.';
    }

    public function delete(): void
    {
        foreach ($this->classes as $class) {
            $class::query()->where(
                'user_id',
                $this->user->id
            )->delete();
        }
    }
}
