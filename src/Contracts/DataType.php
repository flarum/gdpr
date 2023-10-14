<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Contracts;

use Blomstra\Gdpr\Models\ErasureRequest;
use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use Illuminate\Contracts\Filesystem\Factory;
use PhpZip\ZipFile;
use Symfony\Contracts\Translation\TranslatorInterface;

interface DataType
{
    public function __construct(User $user, ?ErasureRequest $erasureRequest, Factory $factory, SettingsRepositoryInterface $settings, UrlGenerator $url, TranslatorInterface $translator);

    public static function dataType(): string;

    public function export(ZipFile $zip): void;

    public function anonymize(): void;

    public function delete(): void;
}
