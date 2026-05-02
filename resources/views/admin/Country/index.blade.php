@extends('admin.layout.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-light fw-bold">Countries</h2>

        <table class="table table-dark table-striped align-middle">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Currency</th>
                <th>Symbol</th>
                <th>Rate</th>
            </tr>
            </thead>

            <tbody>
            @forelse($countries as $country)
                <tr>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->currency }}</td>
                    <td>{{ $country->symbol }}</td>
                    <td>{{ $country->rate }}</td>
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
