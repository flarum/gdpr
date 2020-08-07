<?php

namespace Bokt\Gdpr;

use Flarum\Extend\Frontend;
use Flarum\Extend\Locales;
use Flarum\Extend\Routes;
use Flarum\Extend\View;

return [
    new Extend\Provider(Providers\GdprProvider::class),
    (new Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),
    (new Locales(__DIR__ . '/resources/locale')),
    (new Routes('forum'))
        ->get('/gdpr/export/{file}', 'gdpr.export', Http\Controller\ExportController::class),
    (new Routes('api'))
        ->post('/gdpr/export', 'gdpr.request-export', Api\Controller\RequestExportController::class),
    (new View)->namespace('gdpr', __DIR__ . '/resources/views')
];
