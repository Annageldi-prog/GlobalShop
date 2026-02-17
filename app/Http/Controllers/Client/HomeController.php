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
        // Получаем фильтры из запроса
        $filters = $request->only([
            'country', 'category', 'brand', 'season', 'size', 'gender', 'price_min', 'price_max'
        ]);

        $products = Product::query();

        // Фильтруем по стране через RegionalPrice
        if (!empty($filters['country'])) {
            $products->whereHas('regionalPrices', function($q) use($filters) {
                $q->where('country_id', $filters['country']);
                if (!empty($filters['price_min'])) $q->where('price', '>=', $filters['price_min']);
                if (!empty($filters['price_max'])) $q->where('price', '<=', $filters['price_max']);
            });
        }

        // Фильтруем по категории
        if (!empty($filters['category'])) {
            $products->where('category_id', $filters['category']);
        }

        // Фильтруем по бренду
        if (!empty($filters['brand'])) {
            $products->where('brand_id', $filters['brand']);
        }

        // Фильтруем по сезону
        if (!empty($filters['season'])) {
            $products->where('season_id', $filters['season']);
        }

        // Фильтруем по полу
        if (!empty($filters['gender'])) {
            $products->where('gender', $filters['gender']);
        }

        // Фильтруем по размеру через ProductVariant
        if (!empty($filters['size'])) {
            $products->whereHas('variants', function($q) use($filters) {
                $q->where('size_id', $filters['size']);
            });
        }

        // Получаем продукты с пагинацией
        $products = $products->paginate(12)->withQueryString();

        // Данные для фильтров
        $categories = Category::all();
        $brands = Brand::all();
        $seasons = Seasons::all();
        $sizes = Size::all();
        $countries = Country::all();

        // Количество продуктов после фильтров
        $count = $products->total();

        return view('client.home.index', compact(
            'products','categories','brands','seasons','sizes','countries','count','filters'
        ));
    }
}
