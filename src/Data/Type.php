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
use Blomstra\Gdpr\Models\ErasureRequest;
use Flarum\Database\AbstractModel;
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
        protected ?ErasureRequest $erasureRequest,
        protected Factory $factory,
        protected SettingsRepositoryInterface $settings,
        protected UrlGenerator $url,
        protected TranslatorInterface $translator
    ) {
    }

    public static function exportDescription(): string
    {
        return self::staticTranslator()->trans("blomstra-gdpr.lib.data." . Str::lower(static::dataType()) . ".export_description");
    }

    public static function anonymizeDescription(): string
    {
        return self::staticTranslator()->trans("blomstra-gdpr.lib.data." . Str::lower(static::dataType()) . ".anonymize_description");
    }

    public static function deleteDescription(): string
    {
        return self::staticTranslator()->trans("blomstra-gdpr.lib.data." . Str::lower(static::dataType()) . ".delete_description");
    }

    public static function staticTranslator(): TranslatorInterface
    {
        return resolve(TranslatorInterface::class);
    }

    public static function dataType(): string
    {
        return Str::afterLast(static::class, '\\');
    }

    public function getDisk(?string $name): Filesystem
    {
        return $this->factory->disk($name);
    }

    public function getTableColumns(AbstractModel $model): array
    {
        return $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
    }

    /**
     * Encodes an array of data ready for export.
     *
     * @param array $data
     * @return string
     */
    protected function encodeForExport(array $data): string
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
