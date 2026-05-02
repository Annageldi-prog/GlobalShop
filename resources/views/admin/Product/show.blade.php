@extends('admin.layout.admin')

@section('content')
<div class="container py-5">
    <div class="row g-4 align-items-center">
    
            {{-- 🔥 LEFT: IMAGE --}}
            <div class="col-md-5">
                <img src="{{ asset($product->image ?? 'img/image-1.jpg') }}"
                     alt="{{ $product->name }}"
                     class="img-fluid rounded shadow"
                     style="width: 100%; height: 100%; object-fit: contain; max-height: 500px;">
            </div>
            
            {{-- 🔥 RIGHT: INFO --}}
            <div class="col-md-7 text-light">

                <h3 class="mb-1">{{ $product->name }}</h3>

                @if($product->description)
                    <p class="text-light">{{ $product->description }}</p>
                @endif

                <hr>

                <p><strong>Category:</strong> {{ $product->category->name ?? '-' }}</p>
                <p><strong>Brand:</strong> {{ $product->brand->name ?? '-' }}</p>
                <p><strong>Season:</strong> {{ $product->season->name ?? '-' }}</p>
                <p><strong>Gender:</strong> {{ ucfirst($product->gender) }}</p>
                <p><strong>Base Price:</strong> {{ $product->base_price }}</p>

                <hr>

                {{-- COUNTRIES --}}
                <h5>Countries & Prices</h5>
                <div>
                    @forelse($product->regionalPrices as $price)
                        <span class="badge bg-success mb-1">
                            {{ $price->country->name ?? '-' }}:
                            {{ $price->price }} {{ $price->currency }}
                        </span>
                    @empty
                        <span class="text-muted">No prices</span>
                    @endforelse
                </div>

                <hr>

                {{-- SIZES --}}
                <h5>Sizes</h5>
                <div>
                    @forelse($product->variants as $variant)
                        <span class="badge bg-warning text-dark mb-1">
                            {{ $variant->size->name ?? '-' }} ({{ $variant->stock }})
                        </span>
                    @empty
                        <span class="text-muted">No sizes</span>
                    @endforelse
                </div>

            </div>
        </div>

    </div>
</div>
@endsection