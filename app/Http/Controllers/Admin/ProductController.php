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
    $product->load([
        'category',
        'brand',
        'season',
        'variants.size',
        'regionalPrices.country'
    ]);

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
        'image' => 'nullable|string',
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

    // 🔥 CREATE PRODUCT
    $product = Product::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name . '-' . time()),
        'category_id' => $request->category_id,
        'brand_id' => $request->brand_id,
        'season_id' => $request->season_id,
        'gender' => $request->gender,
        'base_price' => $request->base_price,
        'description' => $request->description,
        'image' => $request->image ?? null,
    ]);

    // 🔥 SIZES
    foreach ($request->sizes as $sizeId => $data) {
        if (!isset($data['active'])) continue;

        ProductVariant::create([
            'product_id' => $product->id,
            'size_id' => $sizeId,
            'stock' => $data['stock'] ?? 0,
        ]);
    }

    // 🔥 COUNTRIES
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
        $product = Product::with([
            'variants',
            'countries'
        ])->findOrFail($id);

        return view('admin.product.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'countries' => Country::all(),
            'seasons' => Seasons::all(),
            'sizes' => Size::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

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

        $product->update([
            'name' => $request->name,
            'slug' => $product->slug, 
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'season_id' => $request->season_id,
            'gender' => $request->gender,
            'base_price' => $request->base_price,
            'description' => $request->description,
        ]);

        $product->variants()->delete();

        foreach ($request->sizes as $sizeId => $data) {
            if (!isset($data['active'])) continue;

            $product->variants()->create([
                'size_id' => $sizeId,
                'stock' => $data['stock'] ?? 0,
            ]);
        }

        $syncData = [];

        foreach ($request->countries as $country) {
            $syncData[$country['id']] = [
                'price' => $country['price'],
                'currency' => $country['currency'],
            ];
        }

        $product->countries()->sync($syncData);

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Product updated successfully!');
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