<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('admin.country.index', compact('countries'));
    }

    public function show($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.country.show', compact('country'));
    }
}
