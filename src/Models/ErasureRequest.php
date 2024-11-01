<?php

/*
 * This file is part of Flarum
 *
 * Copyright (c) 2021 Blomstra Ltd
 * Copyright (c) 2024 Flarum Foundation
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Models;

use Carbon\Carbon;
use Flarum\Database\AbstractModel;
use Flarum\Database\ScopeVisibilityTrait;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int         $id
 * @property int         $user_id
 * @property User        $user
 * @property string      $verification_token
 * @property string      $status
 * @property string|null $reason
 * @property Carbon      $created_at
 * @property Carbon|null $user_confirmed_at
 * @property int|null    $processed_by
 * @property User|null   $processedBy
 * @property string|null $processor_comment
 * @property Carbon|null $processed_at
 * @property string|null $processed_mode
 * @property Carbon|null $canceled_at
 * @property int|null    $canceled_by
 */
class ErasureRequest extends AbstractModel
{
    use ScopeVisibilityTrait;

    const STATUS_AWAITING_USER_CONFIRMATION = 'awaiting_user_confirmation';
    const STATUS_USER_CONFIRMED = 'user_confirmed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_PROCESSED = 'processed';
    const STATUS_MANUAL = 'manual';

    const MODE_ANONYMIZATION = 'anonymization';
    const MODE_DELETION = 'deletion';

    protected $table = 'gdpr_erasure';

    protected $casts = [
        'created_at'        => 'datetime',
        'user_confirmed_at' => 'datetime',
        'processed_at'      => 'datetime',
        'canceled_at'       => 'datetime',
    ];

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function isConfirmed(): bool
    {
        return $this->status === ErasureRequest::STATUS_USER_CONFIRMED && $this->user_confirmed_at;
    }
}
