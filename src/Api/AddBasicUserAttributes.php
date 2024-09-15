<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Api;

use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\User\User;

class AddBasicUserAttributes
{
    public function __invoke(BasicUserSerializer $serializer, User $model, array $attributes): array
    {
        if ($serializer->getActor()->can('seeAnonymizedUserBadges')) {
            $attributes['anonymized'] = $model->anonymized;
        }

        return $attributes;
    }
}
