<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Seasons;
use App\Models\Country;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        
        $filters = $request->only([
            'country', 'category', 'brand', 'season', 'size', 'gender', 'price_min', 'price_max'
        ]);

        $products = Product::query();

        if (!empty($filters['country'])) {
            $products->whereHas('regionalPrices', function($q) use($filters) {
                $q->where('country_id', $filters['country']);
                if (!empty($filters['price_min'])) $q->where('price', '>=', $filters['price_min']);
                if (!empty($filters['price_max'])) $q->where('price', '<=', $filters['price_max']);
            });
        }
    
        if (!empty($filters['category'])) {
            $products->where('category_id', $filters['category']);
        }
     
        if (!empty($filters['brand'])) {
            $products->where('brand_id', $filters['brand']);
        }
       
        if (!empty($filters['season'])) {
            $products->where('season_id', $filters['season']);
        }
    
        if (!empty($filters['gender'])) {
            $products->where('gender', $filters['gender']);
        }
       
        if (!empty($filters['size'])) {
            $products->whereHas('variants', function($q) use($filters) {
                $q->where('size_id', $filters['size']);
            });
        }

     
        $products = $products->paginate(12)->withQueryString();

        $categories = Category::all();
        $brands = Brand::all();
        $seasons = Seasons::all();
        $sizes = Size::all();
        $countries = Country::all();

        $count = $products->total();

        return view('client.home.index', compact(
            'products','categories','brands','seasons','sizes','countries','count','filters'
        ));
    }
}
