<?php

namespace Bokt\Gdpr;

use Flarum\Extend\Routes;

return [
    new Extend\Provider(Providers\GdprProvider::class),
    (new Routes('forum'))
        ->get('/gdpr/export', 'gdpr.export', Http\Controller\ExportController::class)
];
