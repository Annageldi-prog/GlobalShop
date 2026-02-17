<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\Seasons;
use App\Models\Series;
use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('id', 'asc')->get();

        $products = Product::with(['category','brand'])->latest()->get();
        return view('admin.product.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $countries = Country::all();
        $seasons = Seasons::all();
        $sizes = Size::all();

        return view('admin.product.create', compact('categories', 'brands', 'countries', 'seasons', 'sizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'country_id' => 'required|exists:countries,id',
            'season_id' => 'required|exists:seasons,id',
            'size_id' => 'required|exists:sizes,id',
            'gender' => 'required|string',
            'base_price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'country_id' => $request->country_id,
            'season_id' => $request->season_id,
            'size_id' => $request->size_id,
            'gender' => $request->gender,
            'base_price' => $request->base_price,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $countries = Country::all();

        return view('admin.product.edit', compact('product', 'categories', 'brands', 'countries'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);


        $product->delete();

        return redirect()->route('admin.product.index')
            ->with('success', 'Product deleted successfully!');
    }


}
