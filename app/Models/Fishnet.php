<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Fishnet extends Model
{
    protected $table = 'fishnets';

    protected $fillable = ['rfid', 'seller_id', 'customer_id', 'state'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function seller(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'seller_id');
    }

    public function customer(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(FishnetLog::class, 'fishnet_id', 'id');
    }
}
