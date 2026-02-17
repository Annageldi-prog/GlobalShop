<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionalPrice extends Model
{
    protected $fillable = [
        'product_id', 'country_id', 'price'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
