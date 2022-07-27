<?php

namespace Blomstra\Gdpr\Data;

use Flarum\Api\ApiKey;
use Flarum\Http\AccessToken;
use Flarum\User\EmailToken;
use Flarum\User\LoginProvider;
use Flarum\User\PasswordToken;
use PhpZip\ZipFile;

class Tokens extends Type
{
    public function export(ZipFile $zip): void
    {
        // TODO: Implement export() method.
    }

    public function anonymize(): void
    {
        $this->delete();
    }

    public function delete(): void
    {
        ApiKey::where('user_id', $this->user->id)->delete();
        AccessToken::where('user_id', $this->user->id)->delete();
        EmailToken::where('user_id', $this->user->id)->delete();
        LoginProvider::where('user_id', $this->user->id)->delete();
        PasswordToken::where('user_id', $this->user->id)->delete();
    }
}
