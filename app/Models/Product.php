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
        'season_id',
        'gender',
        'base_price',
        'description',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function season()
    {
        return $this->belongsTo(Seasons::class);
    }

   
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function regionalPrices()
    {
        return $this->hasMany(RegionalPrice::class);
    }

    public function countries()
    {
        return $this->belongsToMany(
            Country::class,
            'regional_prices',
            'product_id',
            'country_id'
        )->withPivot('price');
    }
}