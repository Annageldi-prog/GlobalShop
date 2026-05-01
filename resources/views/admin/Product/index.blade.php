@extends('admin.layout.admin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-dark fw-bold">Products</h2>

        <a href="{{ route('admin.product.create') }}" class="btn btn-success shadow-sm px-4">
            ➕ Add Product
        </a>
    </div>

    <table class="table table-dark table-striped align-middle">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Season</th>
            <th>Countries (Prices)</th>
            <th>Sizes (Stock)</th>
            <th>Gender</th>
            <th>Base Price</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @forelse($products as $product)
            <tr>
                <td>{{ $product->id }}</td>

                <td>{{ $product->name }}</td>

                <td>{{ $product->description ?? '-' }}</td>

                <td>{{ $product->category->name ?? '-' }}</td>

                <td>{{ $product->brand->name ?? '-' }}</td>

                <td>{{ $product->season->name ?? '-' }}</td>

                {{-- 🌍 COUNTRIES + PRICES --}}
                <td>
                    @forelse($product->regionalPrices as $price)
                        <span class="badge bg-success">
                            {{ $price->country->name ?? '-' }}:
                            {{ $price->price }}
                        </span>
                    @empty
                        <span class="text-muted">-</span>
                    @endforelse
                </td>

                {{-- 📦 SIZES + STOCK --}}
                <td>
                    @forelse($product->variants as $variant)
                        <span class="badge bg-warning text-dark">
                            {{ $variant->size->name ?? '-' }}
                            ({{ $variant->stock }})
                        </span>
                    @empty
                        <span class="text-muted">-</span>
                    @endforelse
                </td>

                <td>{{ ucfirst($product->gender) }}</td>

                <td>{{ $product->base_price }}</td>

                {{-- ⚙️ ACTIONS --}}
                <td>
                    <div class="d-flex gap-2">

                        <a href="{{ route('admin.product.show', $product->id) }}"
                           class="btn btn-info btn-sm">
                            Show
                        </a>

                        <a href="{{ route('admin.product.edit', $product->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.product.destroy', $product->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this product?')">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                Delete
                            </button>

                        </form>

                    </div>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="11" class="text-center text-muted">
                    No products found
                </td>
            </tr>
        @endforelse
        </tbody>

    </table>
</div>
@endsection