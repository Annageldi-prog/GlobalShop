<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seasons;

class SeasonsController extends Controller
{
    public function index()
    {
        $seasons = Seasons::all();
        return view('admin.seasons.index', compact('seasons'));
    }

    public function show($id)
    {
        $season = Seasons::findOrFail($id);
        return view('admin.seasons.show', compact('season'));
    }
}
