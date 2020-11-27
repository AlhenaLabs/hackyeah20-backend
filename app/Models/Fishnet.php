<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Fishnet extends Model
{
    protected $table = 'fishnets';

    protected $fillable = ['rfid', 'seller_id', 'customer_id', 'state'];

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
        return $this->hasMany(FishnetLog::class, 'id', 'fishnet_id');
    }
}
