@extends('client.layout.app')

@section('content')
    <div class="container mx-auto py-8">

        <h1 class="text-2xl font-bold mb-6">Наши товары</h1>

        <!-- Фильтры -->
        @include('client.home.filters') <!-- пока можно оставить как отдельный partial -->

        <!-- Количество найденных товаров -->
        <p class="mb-4 font-semibold">Найдено товаров: {{ $count }}</p>

        <!-- Сетка продуктов -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="border p-4 rounded shadow hover:shadow-lg transition">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/200' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-2">
                    <h2 class="text-lg font-bold">{{ $product->name }}</h2>
                    <p class="text-gray-700">{{ $product->description }}</p>
                    <p class="mt-1 font-semibold text-blue-600">
                        @if(isset($filters['country']))
                            @php
                                $price = $product->regionalPrices->where('country_id', $filters['country'])->first()->price ?? $product->base_price;
                                $symbol = $product->regionalPrices->where('country_id', $filters['country'])->first()->country->symbol ?? '$';
                            @endphp
                            {{ $price }} {{ $symbol }}
                        @else
                            {{ $product->base_price }} $
                        @endif
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Пагинация -->
        <div class="mt-6">
            {{ $products->links() }}
        </div>

    </div>
@endsection
