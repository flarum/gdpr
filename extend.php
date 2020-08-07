<?php

namespace Bokt\Gdpr;

use Flarum\Extend\Routes;
use Flarum\Extend\View;

return [
    new Extend\Provider(Providers\GdprProvider::class),
    (new Routes('forum'))
        ->get('/gdpr/export/{file}', 'gdpr.export', Http\Controller\ExportController::class),
    (new Routes('api'))
        ->post('/gdpr/export', 'gdpr.request-export', Api\Controllers\RequestExportController::class),
    (new View)->namespace('gdpr', __DIR__ . '/resources/views')
];
