@extends('admin.layout.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <h2 class="mb-4 text-dark fw-bold">Products</h2>
            <a href="{{ route('admin.product.create') }}" class="btn btn-success shadow-sm px-4">
                <i class="bi bi-plus-circle me-2"></i>Add
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
                <th>Countries</th>
                <th>Sizes</th>
                <th>Gender</th>
                <th>Base Price</th>
                <th>Settings</th>
            </tr>
            </thead>

            <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td>{{ $product->brand->name ?? '-' }}</td>
                    <td>{{ $product->season->name ?? '-' }}</td>

                    <td>
                        @forelse($product->regionalPrices as $price)
                            <span class="badge bg-success">{{ $price->country->name ?? '-' }}: {{ $price->price }}</span>
                        @empty
                            -
                        @endforelse
                    </td>

                    <td>
                        @forelse($product->variants as $variant)
                            <span class="badge bg-warning">{{ $variant->size->name ?? '-' }} ({{ $variant->stock }})</span>
                        @empty
                            -
                        @endforelse
                    </td>

                    <td>{{ ucfirst($product->gender) }}</td>
                    <td>{{ $product->base_price }}</td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">

                            <a href="{{ route('admin.product.show', $product->id) }}"
                               class="btn btn-info btn-sm px-3 shadow-sm">
                                Show
                            </a>

                            <a href="{{ route('admin.product.edit', $product->id) }}"
                               class="btn btn-warning btn-sm px-3 shadow-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.product.destroy', $product->id) }}"
                                  method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete') ?? 'Delete this product?' }}')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm px-3 shadow-sm">
                                    Delete
                                </button>
                            </form>

                        </div>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">No products found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
