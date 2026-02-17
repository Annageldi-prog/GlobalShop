@extends('admin.layout.admin')

@section('title', 'Add Product')

@section('content')
    <div class="container-lg py-4">
        <h2 class="text-dark mb-4 fw-bold">Add Product</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.product.store') }}" method="POST" class="bg-dark p-4 rounded shadow form-box">
            @csrf

            {{-- Product Name --}}
            <div class="mb-3">
                <label class="form-label text-light">Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label class="form-label text-light">Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Brand --}}
            <div class="mb-3">
                <label class="form-label text-light">Brand</label>
                <select name="brand_id" class="form-select" required>
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Country --}}
            <div class="mb-3">
                <label class="form-label text-light">Country</label>
                <select name="country_id" class="form-select" required>
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Season --}}
            <div class="mb-3">
                <label class="form-label text-light">Season</label>
                <select name="season_id" class="form-select" required>
                    <option value="">Select Season</option>
                    @foreach($seasons as $season)
                        <option value="{{ $season->id }}" {{ old('season_id') == $season->id ? 'selected' : '' }}>
                            {{ $season->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Size --}}
            <div class="mb-3">
                <label class="form-label text-light">Size</label>
                <select name="size_id" class="form-select" required>
                    <option value="">Select Size</option>
                    @foreach($sizes as $size)
                        <option value="{{ $size->id }}" {{ old('size_id') == $size->id ? 'selected' : '' }}>
                            {{ $size->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Gender --}}
            <div class="mb-3">
                <label class="form-label text-light">Gender</label>
                <select name="gender" class="form-select" required>
                    <option value="">Select Gender</option>
                    <option value="man" {{ old('gender') == 'man' ? 'selected' : '' }}>Man</option>
                    <option value="woman" {{ old('gender') == 'woman' ? 'selected' : '' }}>Woman</option>
                    <option value="unisex" {{ old('gender') == 'unisex' ? 'selected' : '' }}>Unisex</option>
                    <option value="boy" {{ old('gender') == 'boy' ? 'selected' : '' }}>Boy</option>
                    <option value="girl" {{ old('gender') == 'girl' ? 'selected' : '' }}>Girl</option>
                </select>
            </div>

            {{-- Base Price --}}
            <div class="mb-3">
                <label class="form-label text-light">Base Price</label>
                <input type="number" step="0.01" name="base_price" class="form-control" value="{{ old('base_price') }}" required>
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label class="form-label text-light">Description</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-light w-100 mt-3 btn-glow">Add Product</button>
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
