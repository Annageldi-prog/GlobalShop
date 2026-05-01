<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\Seasons;
use App\Models\Size;
use App\Models\ProductVariant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'category',
            'brand',
            'season',
            'variants.size',
            'regionalPrices.country'
        ])->get();

        return view('admin.product.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function create()
    {
        return view('admin.product.create', [
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'countries' => Country::all(),
            'seasons' => Seasons::all(),
            'sizes' => Size::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

            'category_id' => 'required',
            'brand_id' => 'required',
            'season_id' => 'required',

            'gender' => 'required',
            'base_price' => 'required|numeric',

            'countries' => 'required|array',
            'countries.*.id' => 'required|exists:countries,id',
            'countries.*.price' => 'required|numeric',
            'countries.*.currency' => 'required',

            'sizes' => 'required|array',
            'sizes.*.stock' => 'nullable|numeric',
        ]);

   
        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name . '-' . time()),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'season_id' => $request->season_id,
            'gender' => $request->gender,
            'base_price' => $request->base_price,
            'description' => $request->description,
        ]);

       
        foreach ($request->sizes as $sizeId => $data) {
            if (!isset($data['active'])) continue;

            ProductVariant::create([
                'product_id' => $product->id,
                'size_id' => $sizeId,
                'stock' => $data['stock'] ?? 0,
            ]);
        }

        foreach ($request->countries as $country) {
            $product->countries()->attach($country['id'], [
                'price' => $country['price'],
                'currency' => $country['currency'],
            ]);
        }

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.product.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'countries' => Country::all(),
            'seasons' => Seasons::all(),
            'sizes' => Size::all(),
        ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Product deleted successfully!');
    }
}