<?php

namespace Blomstra\Gdpr\Events;

use Blomstra\Gdpr\Models\ErasureRequest;

class Erasing
{
    public function __construct(
        public ErasureRequest $user,
    )
    {}
}
