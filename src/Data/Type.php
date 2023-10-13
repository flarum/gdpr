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
use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class Type implements DataType
{
    public function __construct(
        protected User $user,
        protected Factory $factory,
        protected SettingsRepositoryInterface $settings,
        protected UrlGenerator $url,
        protected TranslatorInterface $translator
    ) {
    }

    public static function dataType(): string
    {
        return Str::afterLast(static::class, '\\');
    }

    public function getDisk(?string $name): Filesystem
    {
        return $this->factory->disk($name);
    }
}
