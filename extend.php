<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr;

use Blomstra\Gdpr\Api\Serializer\ExportSerializer;
use Blomstra\Gdpr\Api\Serializer\RequestErasureSerializer;
use Blomstra\Gdpr\Models\ErasureRequest;
use Flarum\Api\Controller\ShowUserController;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Extend;
use Flarum\User\User;

return [
    (new Extend\Frontend('forum'))->js(__DIR__.'/js/dist/forum.js'),

    (new Extend\Locales(__DIR__.'/resources/locale')),

    (new Extend\Routes('forum'))
        ->get('/gdpr/export/{file}', 'gdpr.export', Http\Controller\ExportController::class)
        ->get('/gdpr/erasure/confirm/{token}', 'gdpr.erasure.confirm', Http\Controller\ConfirmErasureController::class),

    (new Extend\Routes('api'))
        ->post('/gdpr/export', 'gdpr.request-export', Api\Controller\RequestExportController::class)
        ->post('/user-erasure-requests', 'gdpr.erasure.create', Api\Controller\RequestErasureController::class)
        ->delete('/user-erasure-requests/{id}', 'gdpr.erasure.cancel', Api\Controller\CancelErasureController::class),

    (new Extend\Notification())
        ->type(Notifications\ExportAvailableBlueprint::class, ExportSerializer::class, ['alert', 'email'])
        ->type(Notifications\ConfirmErasureBlueprint::class, RequestErasureSerializer::class, ['email'])
        ->type(Notifications\ErasureRequestCancelledBlueprint::class, RequestErasureSerializer::class, ['alert', 'email']),

    (new Extend\Model(User::class))
        ->hasOne('erasureRequest', ErasureRequest::class),

    (new Extend\ApiController(ShowUserController::class))
        ->addInclude('erasureRequest'),

    (new Extend\ApiSerializer(UserSerializer::class))
        ->hasOne('erasureRequest', RequestErasureSerializer::class),

    (new Extend\View())->namespace('gdpr', __DIR__.'/resources/views'),

    (new Extend\Console())->command(Console\DestroyExportsCommand::class),

    (new Extend\ServiceProvider())->register(Providers\GdprProvider::class),
];
