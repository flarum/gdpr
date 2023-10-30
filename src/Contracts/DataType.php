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
use Symfony\Contracts\Translation\TranslatorInterface;

interface DataType
{
    public function __construct(User $user, ?ErasureRequest $erasureRequest, Factory $factory, SettingsRepositoryInterface $settings, UrlGenerator $url, TranslatorInterface $translator);

    public static function dataType(): string;

    /**
     * Description of what this data type contains.
     *
     * @return string
     */
    public static function exportDescription(): string;

    /**
     * Data to be added to the zipfile.
     *
     * @return array<string, string>|array<array<string, string>>|null
     *
     * - array<string, string>: Represents a single data set, e.g., ['filename.json' => '{...data...}']
     * - array<array<string, string>>: Represents multiple data sets, e.g., [['filename1.json' => '{...data1...}'], ['filename2.json' => '{...data2...}']]
     * - null: No data available for export.
     */
    public function export(): ?array;

    /**
     * Description of what happens to the data when it is anonymized.
     *
     * @return string
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
     * @return string
     */
    public static function deleteDescription(): string;

    /**
     * Logic to delete the data.
     *
     * @return void
     */
    public function delete(): void;
}
