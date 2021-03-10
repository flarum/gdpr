<?php

namespace Blomstra\Gdpr\Command;

use Flarum\User\User;

class RequestDeletion
{
    /**
     * The user performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * The attributes of the new deletion request.
     *
     * @var array
     */
    public $data;

    /**
     * @param User $actor
     * @param array $data
     */
    public function __construct(User $actor, array $data)
    {
        $this->actor = $actor;
        $this->data = $data;
    }
}
