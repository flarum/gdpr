<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Models;

use Flarum\Database\AbstractModel;
use Flarum\User\User;

class ErasureRequest extends AbstractModel
{
    protected $table = 'gdpr_erasure';
    protected $dates = ['created_at', 'user_confirmed_at', 'processed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class);
    }
}
