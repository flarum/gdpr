<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Providers;

use Flarum\Foundation\AbstractServiceProvider;

class GdprProvider extends AbstractServiceProvider
{
     public function register()
    {
        /**
         * By default, we now deny any action on an anonymized user, ie `$actor->can('someAction', $user)` will return `deny`.
         * 
         * If you want to allow some specific actions still, they must be added to the reservedAbilities array. These will still be subject to the regular permission checks.
         * 
         * @example
         * ```php
         * $this->container->extend('gdpr.user.reservedAbilities', function ($reservedAbilities) {
         *    return array_merge($reservedAbilities, ['myCustomAbility']);
         * });
         * ```
         */
        $this->container->bind('gdpr.user.reservedAbilities', function (): array {
            return [
                'delete', // Allows those with the permission to still delete users
            ];
        });
    }
}
