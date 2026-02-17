<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'currency', 'symbol', 'rate'];

    public function brands() {
        return $this->hasMany(Brand::class);
    }

    public function regionalPrices() {
        return $this->hasMany(RegionalPrice::class);
    }
}
