<?php

namespace Blomstra\Gdpr;

use Blomstra\Gdpr\Api\Serializer\ExportSerializer;
use Blomstra\Gdpr\Notifications\ExportAvailableBlueprint;
use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))->js(__DIR__ . '/js/dist/forum.js'),

    (new Extend\Locales(__DIR__ . '/resources/locale')),

    (new Extend\Routes('forum'))
        ->get('/gdpr/export/{file}', 'gdpr.export', Http\Controller\ExportController::class),

    (new Extend\Routes('api'))
        ->post('/gdpr/export', 'gdpr.request-export', Api\Controller\RequestExportController::class),

    (new Extend\Notification)->type(ExportAvailableBlueprint::class, ExportSerializer::class, ['alert', 'email']),

    (new Extend\View)->namespace('gdpr', __DIR__ . '/resources/views'),

    (new Extend\Console)->command(Commands\DestroyExportsCommand::class),

    (new Extend\ServiceProvider)->register(Providers\GdprProvider::class)
];
