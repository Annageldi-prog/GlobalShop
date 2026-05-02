@extends('admin.layout.admin')

@section('content')
    <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-light fw-bold">Category</h2>

        <a href="{{ route('admin.category.create') }}" class="btn btn-dark shadow-sm px-4">
                <i class="bi bi-plus-circle me-1"></i> Add
            </a>
    </div>
        <table class="table table-dark table-striped align-middle">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            </thead>

            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center text-muted">category yok</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
@endsection
