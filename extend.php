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
use Flarum\Api\Serializer\CurrentUserSerializer;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Extend;
use Flarum\User\User;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\Routes('forum'))
        ->get('/gdpr/export/{file}', 'gdpr.export', Http\Controller\ExportController::class)
        ->get('/gdpr/erasure/confirm/{token}', 'gdpr.erasure.confirm', Http\Controller\ConfirmErasureController::class),

    (new Extend\Routes('api'))
        ->remove('users.delete')
        ->delete('/users/{id}', 'users.delete', Api\Controller\DeleteUserController::class)
        ->post('/gdpr/export', 'gdpr.request-export', Api\Controller\RequestExportController::class)
        ->get('/user-erasure-requests', 'gdpr.erasure.index', Api\Controller\ListErasureRequestsController::class)
        ->post('/user-erasure-requests', 'gdpr.erasure.create', Api\Controller\RequestErasureController::class)
        ->patch('/user-erasure-requests/{id}', 'gdpr.erasure.process', Api\Controller\ProcessErasureController::class)
        ->delete('/user-erasure-requests/{id}', 'gdpr.erasure.cancel', Api\Controller\CancelErasureController::class),

    (new Extend\Notification())
        ->type(Notifications\ExportAvailableBlueprint::class, ExportSerializer::class, ['alert', 'email'])
        ->type(Notifications\ConfirmErasureBlueprint::class, RequestErasureSerializer::class, ['email'])
        ->type(Notifications\ErasureRequestCancelledBlueprint::class, RequestErasureSerializer::class, ['alert', 'email']),

    (new Extend\Model(User::class))
        ->hasOne('erasureRequest', ErasureRequest::class),

    (new Extend\ApiController(ShowUserController::class))
        ->addInclude('erasureRequest'),

    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attributes(AddForumAttributes::class),

    (new Extend\ApiSerializer(UserSerializer::class))
        ->hasOne('erasureRequest', RequestErasureSerializer::class),

    (new Extend\ApiSerializer(CurrentUserSerializer::class))
        ->attribute('canModerateExports', function (CurrentUserSerializer $serializer) {
            return $serializer->getActor()->can('moderateExports');
        }),

    (new Extend\Settings())
        ->default('blomstra-gdpr.allow-anonymization', true)
        ->default('blomstra-gdpr.allow-deletion', false)
        ->default('blomstra-gdpr.default-erasure', ErasureRequest::MODE_ANONYMIZATION)
        ->serializeToForum('erasureAnonymizationAllowed', 'blomstra-gdpr.allow-anonymization', 'boolVal')
        ->serializeToForum('erasureDeletionAllowed', 'blomstra-gdpr.allow-deletion', 'boolVal'),

    (new Extend\View())
        ->namespace('gdpr', __DIR__.'/resources/views'),

    (new Extend\Console())
        ->command(Console\DestroyExportsCommand::class)
        ->command(Console\ProcessEraseRequests::class)
        ->schedule(Console\ProcessEraseRequests::class, Console\DailySchedule::class)
        ->schedule(Console\DestroyExportsCommand::class, Console\DailySchedule::class),

    (new Extend\ServiceProvider())
        ->register(Providers\GdprProvider::class),

    (new Extend\Filesystem())
        ->disk('gdpr-export', ExportDiskConfig::class),

    (new Extend\Conditional())
        ->whenExtensionEnabled('fof-oauth', fn () => [
            (new Extend\ApiSerializer(ForumSerializer::class))
                ->attribute('passwordlessSignUp', function (ForumSerializer $serializer) {
                    return !$serializer->getActor()->isGuest() && $serializer->getActor()->loginProviders()->count() > 0;
                }),
        ]),
];
