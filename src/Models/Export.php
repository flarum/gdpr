<?php

namespace Bokt\Gdpr\Models;

use Carbon\Carbon;
use Flarum\Database\AbstractModel;
use Flarum\User\User;

/**
 * @property int $id
 * @property int $user_id
 * @property string $file
 * @property Carbon $created_at
 * @property Carbon $destroys_at
 * @property User $user
 */
class Export extends AbstractModel
{
    protected $table = 'gdpr_exports';
    protected $dates = ['created_at', 'destroys_at'];

    public static function byFile(string $file): ?self
    {
        return self::query()
            ->where('file', $file)
            ->first();
    }

    public static function exported(User $user, string $tmp)
    {
        return tap(new self, function ($export) use ($user, $tmp) {
            $export->user_id = $user->id;
            $export->file = $tmp;
            $export->created_at = Carbon::now();
            $export->destroys_at = Carbon::now()->addDay();
            $export->save();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function destroyable()
    {
        return self::query()
            ->where('destroys_at', '<=', Carbon::now());
    }
}
