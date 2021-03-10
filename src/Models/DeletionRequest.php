<?php

namespace Blomstra\Gdpr\Models;

use Flarum\Database\AbstractModel;
use Flarum\User\User;

class DeletionRequest extends AbstractModel
{
    protected $table = 'gdpr_deletion';
    protected $dates = ['created_at', 'user_confirmed_at', 'processed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}