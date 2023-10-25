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

    /**
     * Description of what this data type contains.
     *
     * @return non-empty-string
     */
    public static function exportDescription(): string;

    /**
     * Logic to add the data to the zip file.
     *
     * @param ZipFile $zip
     * @return void
     */
    public function export(ZipFile $zip): void;

    /**
     * Description of what happens to the data when it is anonymized.
     *
     * @return non-empty-string
     */
    public static function anonymizeDescription(): string;

    /**
     * Logic to anonymize the data.
     *
     * @return void
     */
    public function anonymize(): void;

    /**
     * Description of what happens to the data when it is deleted.
     *
     * @return non-empty-string
     */
    public static function deleteDescription(): string;

    /**
     * Logic to delete the data.
     *
     * @return void
     */
    public function delete(): void;
}
