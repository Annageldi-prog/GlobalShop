@extends('admin.layout.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-dark fw-bold">Brands</h2>

        <table class="table table-dark table-striped align-middle">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Country</th>
            </tr>
            </thead>

            <tbody>
            @forelse($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->country->name ?? '-' }}</td>
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

