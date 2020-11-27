<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FishnetLog extends Model
{
    protected $table = 'fishnets_logs';

    protected $fillable = ['fishnet_id', 'user_id', 'type'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public static function log(int $userId, int $fishnetId, string $type): void
    {
        $fishnetLog = new FishnetLog();

        $fishnetLog->fill([
            'fishnet_id' => $fishnetId,
            'user_id' => $userId,
            'type' => $type
        ]);

        $fishnetLog->save();
    }

    public function fishnet(): HasOne
    {
        return $this->hasOne(Fishnet::class, 'id', 'fishnet_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
