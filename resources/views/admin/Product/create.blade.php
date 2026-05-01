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

     
        <div class="mb-3">
            <label class="form-label text-light">Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

    
        <div class="mb-3">
            <label class="form-label text-light">Category</label>
            <select name="category_id" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

       
        <div class="mb-3">
            <label class="form-label text-light">Brand</label>
            <select name="brand_id" class="form-select" required>
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

    
        <div class="mb-3">
            <label class="form-label text-light">Countries & Prices</label>

            <div id="countries-wrapper">
                <div class="country-item d-flex gap-2 mb-2">

                    <select name="countries[0][id]" class="form-select" required>
                        <option value="">Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>

                    <input type="number" step="0.01" name="countries[0][price]" class="form-control" placeholder="Price" required>

                    <select name="countries[0][currency]" class="form-select" required>
                        <option value="">Currency</option>
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="CAD">CAD</option>
                        <option value="TRY">TRY</option>
                    </select>

                    <button type="button" class="btn btn-danger" onclick="removeRow(this)">❌</button>
                </div>
            </div>

            <button type="button" class="btn btn-light mt-2" onclick="addCountry()">➕ Add Country</button>
        </div>

        <div class="mb-3">
            <label class="form-label text-light">Sizes & Stock</label>

            @foreach($sizes as $size)
                <div class="row mb-2 align-items-center">

                    <div class="col-6 text-light">
                        <input type="checkbox" name="sizes[{{ $size->id }}][active]" value="1">
                        {{ $size->name }}
                    </div>

                    <div class="col-6">
                        <input type="number"
                               name="sizes[{{ $size->id }}][stock]"
                               class="form-control"
                               placeholder="Stock">
                    </div>

                </div>
            @endforeach
        </div>

        
        <div class="mb-3">
            <label class="form-label text-light">Season</label>
            <select name="season_id" class="form-select" required>
                @foreach($seasons as $season)
                    <option value="{{ $season->id }}">{{ $season->name }}</option>
                @endforeach
            </select>
        </div>

        
        <div class="mb-3">
            <label class="form-label text-light">Gender</label>
            <select name="gender" class="form-select" required>
                <option value="man">Man</option>
                <option value="woman">Woman</option>
                <option value="unisex">Unisex</option>
                <option value="boy">Boy</option>
                <option value="girl">Girl</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label text-light">Base Price</label>
            <input type="number" step="0.01" name="base_price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-light">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-light w-100">Add Product</button>
    </form>
</div>

<script>
let index = 1;

function addCountry() {
    let wrapper = document.getElementById('countries-wrapper');

    let html = `
    <div class="country-item d-flex gap-2 mb-2">

        <select name="countries[${index}][id]" class="form-select" required>
            <option value="">Country</option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>

        <input type="number" step="0.01" name="countries[${index}][price]" class="form-control" placeholder="Price" required>

        <select name="countries[${index}][currency]" class="form-select" required>
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="GBP">GBP</option>
            <option value="CAD">CAD</option>
            <option value="TRY">TRY</option>
        </select>

        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">❌</button>

    </div>`;

    wrapper.insertAdjacentHTML('beforeend', html);
    index++;
}
</script>

<style>
.form-box {
    border:1px solid #fff;
    background:linear-gradient(145deg,#000,#ffd5d5);
}
.form-control, .form-select {
    background:#000 !important;
    color:#fff !important;
}
</style>

@endsection