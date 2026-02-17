<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('admin.size.index', compact('sizes'));
    }

    public function show($id)
    {
        $size = Size::findOrFail($id);
        return view('admin.size.show', compact('size'));
    }
}
