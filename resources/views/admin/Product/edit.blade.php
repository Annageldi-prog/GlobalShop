@extends('admin.layout.admin')

@section('title', __('messages.add_product'))

@section('content')
    <div class="container-lg py-4">


        <h2 class="text-dark mb-4 fw-bold">Add Product</h2>

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-dark p-4 rounded shadow form-box">

            @csrf

            {{-- Product Title --}}
            <div class="mb-3">
                <label for="name" class="form-label text-light">Product Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name') }}" required>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label for="category_id" class="form-label text-light">Category</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">select category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Author --}}
            <div class="mb-3">
                <label for="brand_id" class="form-label text-light">Brand</label>
                <select name="brand_id" id="brand_id" class="form-select" required>
                    <option value="">select brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Series --}}
            <div class="mb-3">
                <label for="series_id" class="form-label text-light">Country</label>
                <select name="series_id" id="series_id" class="form-select" required>
                    <option value="">select country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Price --}}
            <div class="mb-3">
                <label for="price" class="form-label text-light">Base Price</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control"
                       value="{{ old('price') }}" required>
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label text-light">Description</label>
                <textarea name="description" id="description" rows="4" class="form-control"
                          placeholder="description">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-warning w-100 mt-3 btn-glow">
                Add Product
            </button>

        </form>
    </div>

    <style>
        .form-box { border:1px solid #fff; background:linear-gradient(145deg,#000,#ffd5d5);}
        .form-control, .form-select { background-color:#000 !important; color:#f5f1f1 !important; border:1px solid #000;}
        .form-control:focus, .form-select:focus { border-color:#fff; box-shadow:0 0 5px #fff;}
        .btn-glow { font-weight:bold; border-radius:6px; background:linear-gradient(135deg,#000,#ffd5d5); color:#000; transition:0.3s;}
        .btn-glow:hover { background:linear-gradient(135deg,#0e0d09,#ffd5d5); box-shadow:0 0 8px #f8f7f2;}
    </style>

@endsection
