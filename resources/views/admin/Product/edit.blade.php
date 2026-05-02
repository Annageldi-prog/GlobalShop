@extends('admin.layout.admin')

@section('title', __('messages.add_product'))

@section('content')
<div class="container-lg py-4">

    <h2 class="text-light mb-4 fw-bold">Edit Product</h2>

    <form action="{{ route('admin.product.update', $product->id) }}"
          method="POST"
          class="bg-dark p-4 rounded shadow form-box">

        @csrf
        @method('PUT')

        {{-- Product Name --}}
        <div class="mb-3">
            <label class="form-label text-light">Product Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $product->name) }}" required>
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label class="form-label text-light">Category</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Brand --}}
        <div class="mb-3">
            <label class="form-label text-light">Brand</label>
            <select name="brand_id" class="form-select" required>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}"
                        {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Season --}}
        <div class="mb-3">
            <label class="form-label text-light">Season</label>
            <select name="season_id" class="form-select" required>
                @foreach($seasons as $season)
                    <option value="{{ $season->id }}"
                        {{ $product->season_id == $season->id ? 'selected' : '' }}>
                        {{ $season->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- 🔥 COUNTRIES (оставил твой стиль) --}}
        <div class="mb-3">
            <label class="form-label text-light">Countries & Prices</label>

            <div id="countries-wrapper">
                @foreach($product->countries as $i => $country)
                    <div class="d-flex gap-2 mb-2">

                        <select name="countries[{{ $i }}][id]" class="form-select" required>
                            @foreach($countries as $c)
                                <option value="{{ $c->id }}"
                                    {{ $c->id == $country->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>

                        <input type="number"
                               step="0.01"
                               name="countries[{{ $i }}][price]"
                               class="form-control"
                               value="{{ $country->pivot->price }}"
                               required>

                        <select name="countries[{{ $i }}][currency]" class="form-select" required>
                            <option value="USD" {{ $country->pivot->currency == 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="EUR" {{ $country->pivot->currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                            <option value="GBP" {{ $country->pivot->currency == 'GBP' ? 'selected' : '' }}>GBP</option>
                            <option value="TRY" {{ $country->pivot->currency == 'TRY' ? 'selected' : '' }}>TRY</option>
                        </select>

                        <button type="button" class="btn btn-danger" onclick="removeRow(this)">❌</button>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-light mt-2" onclick="addRow()">➕ Add Country</button>
        </div>

        {{-- 🔥 SIZES (новое, но в твоём стиле) --}}
        <div class="mb-3">
            <label class="form-label text-light">Sizes</label>

            @php
                $existingSizes = $product->variants->keyBy('size_id');
            @endphp

            @foreach($sizes as $size)
                <div class="d-flex gap-2 mb-2">
                    <input type="checkbox"
                           name="sizes[{{ $size->id }}][active]"
                           {{ isset($existingSizes[$size->id]) ? 'checked' : '' }}>

                    <span class="text-light">{{ $size->name }}</span>

                    <input type="number"
                           name="sizes[{{ $size->id }}][stock]"
                           class="form-control"
                           placeholder="stock"
                           value="{{ $existingSizes[$size->id]->stock ?? 0 }}">
                </div>
            @endforeach
        </div>

        {{-- Gender --}}
        <div class="mb-3">
            <label class="form-label text-light">Gender</label>
            <select name="gender" class="form-select" required>
                <option value="man" {{ $product->gender == 'man' ? 'selected' : '' }}>Man</option>
                <option value="woman" {{ $product->gender == 'woman' ? 'selected' : '' }}>Woman</option>
                <option value="unisex" {{ $product->gender == 'unisex' ? 'selected' : '' }}>Unisex</option>
                <option value="boy" {{ $product->gender == 'boy' ? 'selected' : '' }}>Boy</option>
                <option value="girl" {{ $product->gender == 'girl' ? 'selected' : '' }}>Girl</option>
            </select>
        </div>

        {{-- Base Price --}}
        <div class="mb-3">
            <label class="form-label text-light">Base Price</label>
            <input type="number" step="0.01" name="base_price"
                   class="form-control"
                   value="{{ $product->base_price }}" required>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label text-light">Description</label>
            <textarea name="description" rows="4" class="form-control">{{ $product->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning w-100 mt-3 btn-glow">
            Update Product
        </button>

    </form>
</div>

{{-- JS (оставил как у тебя) --}}
<script>
let index = {{ $product->countries->count() }};

function addRow() {
    let wrapper = document.getElementById('countries-wrapper');

    let html = `
        <div class="d-flex gap-2 mb-2">
            <select name="countries[${index}][id]" class="form-select">
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>

            <input type="number" step="0.01" name="countries[${index}][price]" class="form-control">

            <select name="countries[${index}][currency]" class="form-select">
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <option value="TRY">TRY</option>
            </select>

            <button type="button" class="btn btn-danger" onclick="removeRow(this)">❌</button>
        </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', html);
    index++;
}

function removeRow(btn) {
    btn.parentElement.remove();
}
</script>

<style>
    .form-box { border:1px solid #fff; background:linear-gradient(145deg,#000,#ffd5d5);}
    .form-control, .form-select { background-color:#000 !important; color:#f5f1f1 !important; border:1px solid #000;}
    .form-control:focus, .form-select:focus { border-color:#fff; box-shadow:0 0 5px #fff;}
    .btn-glow { font-weight:bold; border-radius:6px; background:linear-gradient(135deg,#000,#ffd5d5); color:#000; transition:0.3s;}
    .btn-glow:hover { background:linear-gradient(135deg,#0e0d09,#ffd5d5); box-shadow:0 0 8px #f8f7f2;}
</style>
@endsection