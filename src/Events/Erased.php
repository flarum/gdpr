<?php

namespace Blomstra\Gdpr\Events;

class Erased
{
    public function __construct(
        public string $username,
        public string $email,
        public string $mode
    )
    {}
}
