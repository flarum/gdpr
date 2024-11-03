<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Flarum\Gdpr;

use Flarum\Api\Controller\ShowForumController;
use Flarum\Api\Controller\ShowUserController;
use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Extend;
use Flarum\Gdpr\Api\Serializer\ExportSerializer;
use Flarum\Gdpr\Api\Serializer\RequestErasureSerializer;
use Flarum\Gdpr\Models\ErasureRequest;
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
        ->type(Notifications\ExportAvailableBlueprint::class, ExportSerializer::class, ['alert', 'email'])
        ->type(Notifications\ConfirmErasureBlueprint::class, RequestErasureSerializer::class, ['email'])
        ->type(Notifications\ErasureRequestCancelledBlueprint::class, RequestErasureSerializer::class, ['alert', 'email']),

    (new Extend\Model(User::class))
        ->cast('anonymized', 'boolean')
        ->hasOne('erasureRequest', ErasureRequest::class),

    (new Extend\ApiController(ShowUserController::class))
        ->addInclude('erasureRequest'),

    (new Extend\ApiController(ShowForumController::class))
        ->addInclude('actor.erasureRequest'),

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
        ->default('flarum-gdpr.allow-anonymization', true)
        ->default('flarum-gdpr.allow-deletion', false)
        ->default('flarum-gdpr.default-anonymous-username', 'Anonymous')
        ->default('flarum-gdpr.default-erasure', ErasureRequest::MODE_ANONYMIZATION)
        ->serializeToForum('erasureAnonymizationAllowed', 'flarum-gdpr.allow-anonymization', 'boolVal')
        ->serializeToForum('erasureDeletionAllowed', 'flarum-gdpr.allow-deletion', 'boolVal'),

    (new Extend\View())
        ->namespace('flarum-gdpr', __DIR__.'/resources/views'),

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
];
