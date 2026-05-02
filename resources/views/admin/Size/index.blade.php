@extends('admin.layout.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-light fw-bold">Sizes</h2>

        <table class="table table-dark table-striped align-middle">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            </thead>

            <tbody>
            @forelse($sizes as $size)
                <tr>
                    <td>{{ $size->id }}</td>
                    <td>{{ $size->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center text-muted">size yok</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
@endsection
