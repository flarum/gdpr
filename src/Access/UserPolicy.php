<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Access;

use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class UserPolicy extends AbstractPolicy
{
    public array $reservedAbilities;

    public function __construct()
    {
        $this->reservedAbilities = resolve('gdpr.user.reservedAbilities');
    }

    public function can(User $actor, $ability, mixed $user)
    {
        // if $user is anonymized, deny all abilities except those in $reservedAbilities
        if ($user instanceof User
            && $user->anonymized
            && !in_array($ability, $this->reservedAbilities)) {
            return $this->deny();
        }
    }

    public function exportFor(User $actor, User $user)
    {
        if ($user->anonymized) {
            return $this->deny();
        }

        return $actor->hasPermission('moderateExport');
    }
}
