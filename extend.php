<?php

namespace Blomstra\Gdpr;

use Blomstra\Gdpr\Api\Serializer\ExportSerializer;
use Blomstra\Gdpr\Api\Serializer\RequestErasureSerializer;
use Blomstra\Gdpr\Notifications;
use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))->js(__DIR__ . '/js/dist/forum.js'),

    (new Extend\Locales(__DIR__ . '/resources/locale')),

    (new Extend\Routes('forum'))
        ->get('/gdpr/export/{file}', 'gdpr.export', Http\Controller\ExportController::class),

    (new Extend\Routes('api'))
        ->post('/gdpr/export', 'gdpr.request-export', Api\Controller\RequestExportController::class)
        ->post('/gdpr/delete-me', 'gdpr.request-deletion', Api\Controller\RequestAnonymizationController::class),

    (new Extend\Notification)
        ->type(Notifications\ExportAvailableBlueprint::class, ExportSerializer::class, ['alert', 'email'])
        ->type(Notifications\ConfirmDeletionBlueprint::class, RequestErasureSerializer::class, ['email']),

    (new Extend\View)->namespace('gdpr', __DIR__ . '/resources/views'),

    (new Extend\Console)->command(Console\DestroyExportsCommand::class),

    (new Extend\ServiceProvider)->register(Providers\GdprProvider::class)
];
