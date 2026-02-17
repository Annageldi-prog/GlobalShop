<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'brand_id',
        'country_id',
        'season_id',
        'size_id',
        'gender',
        'base_price',
        'description',
    ];



    // Связи
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function season() {
        return $this->belongsTo(Seasons::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function regionalPrices() {
        return $this->hasMany(RegionalPrice::class);
    }
}
