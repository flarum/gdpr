<?php

namespace Blomstra\Gdpr\Api;

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
