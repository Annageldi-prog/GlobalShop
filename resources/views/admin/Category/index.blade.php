@extends('admin.layout.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-dark fw-bold">Categories</h2>

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
