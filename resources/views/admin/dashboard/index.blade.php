@extends('admin.layout.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="mb-4">Welcome, Admin!</h1>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <p class="card-text">{{ \App\Models\Category::count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Brands</h5>
                    <p class="card-text">{{ \App\Models\Brand::count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text">{{ \App\Models\Product::count() }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
