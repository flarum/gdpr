<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr;

use Flarum\Gdpr\Api\Serializer\ExportSerializer;
use Flarum\Gdpr\Api\Serializer\RequestErasureSerializer;
use Flarum\Gdpr\Models\ErasureRequest;
use Flarum\Api\Controller\ShowUserController;
use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Extend;
use Flarum\User\User;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),

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
        ->delete('/users/{id}/gdpr/{mode}', 'users.delete.mode', Api\Controller\DeleteUserController::class)
        ->post('/gdpr/export', 'gdpr.request-export', Api\Controller\RequestExportController::class)
        ->get('/user-erasure-requests', 'gdpr.erasure.index', Api\Controller\ListErasureRequestsController::class)
        ->post('/user-erasure-requests', 'gdpr.erasure.create', Api\Controller\CreateErasureRequestController::class)
        ->patch('/user-erasure-requests/{id}', 'gdpr.erasure.process', Api\Controller\UpdateErasureRequestController::class)
        ->delete('/user-erasure-requests/{id}', 'gdpr.erasure.cancel', Api\Controller\DeleteErasureRequestController::class)
        ->get('/gdpr/datatypes', 'gdpr.datatypes.index', Api\Controller\ListDataTypesController::class)
        ->get('/gdpr/datatypes/user-columns', 'gdpr.datatypes.user-columns', Api\Controller\ListUserColumnsDataController::class),

    (new Extend\Notification())
        ->type(Notifications\ExportAvailableBlueprint::class, ['alert', 'email'])
        ->type(Notifications\ConfirmErasureBlueprint::class, ['email'])
        ->type(Notifications\ErasureRequestCancelledBlueprint::class, ['alert', 'email']),

    (new Extend\Model(User::class))
        ->cast('anonymized', 'boolean')
        ->hasOne('erasureRequest', ErasureRequest::class),

    (new Extend\ApiController(ShowUserController::class))
        ->addInclude('erasureRequest'),

    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attributes(AddForumAttributes::class),

    (new Extend\ApiSerializer(BasicUserSerializer::class))
        ->attributes(Api\AddBasicUserAttributes::class),

    (new Extend\ApiSerializer(UserSerializer::class))
        ->attribute('canModerateExports', function (UserSerializer $serializer, User $user) {
            return $serializer->getActor()->can('exportFor', $user);
        })
        ->hasOne('erasureRequest', RequestErasureSerializer::class),

    (new Extend\Settings())
        ->default('blomstra-gdpr.allow-anonymization', true)
        ->default('blomstra-gdpr.allow-deletion', false)
        ->default('blomstra-gdpr.default-anonymous-username', 'Anonymous')
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

    (new Extend\Policy())
        ->modelPolicy(User::class, Access\UserPolicy::class),

    (new Extend\Conditional())
        ->whenExtensionEnabled('fof-oauth', fn () => [
            (new Extend\ApiSerializer(ForumSerializer::class))
                ->attribute('passwordlessSignUp', function (ForumSerializer $serializer) {
                    return !$serializer->getActor()->isGuest() && $serializer->getActor()->loginProviders()->count() > 0;
                }),
        ]),
];
