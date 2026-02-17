<!-- resources/views/client/home/filters.blade.php -->

<form method="GET" action="{{ route('client.home') }}" class="mb-6 flex flex-wrap gap-4">

    <!-- Страна -->
    <select name="country" class="border p-2 rounded">
        <option value="">Все страны</option>
        @foreach($countries as $country)
            <option value="{{ $country->id }}" {{ (isset($filters['country']) && $filters['country']==$country->id)?'selected':'' }}>
                {{ $country->name }}
            </option>
        @endforeach
    </select>

    <!-- Категория -->
    <select name="category" class="border p-2 rounded">
        <option value="">Все категории</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ (isset($filters['category']) && $filters['category']==$category->id)?'selected':'' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <!-- Бренд -->
    <select name="brand" class="border p-2 rounded">
        <option value="">Все бренды</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" {{ (isset($filters['brand']) && $filters['brand']==$brand->id)?'selected':'' }}>
                {{ $brand->name }}
            </option>
        @endforeach
    </select>

    <!-- Сезон -->
    <select name="season" class="border p-2 rounded">
        <option value="">Все сезоны</option>
        @foreach($seasons as $season)
            <option value="{{ $season->id }}" {{ (isset($filters['season']) && $filters['season']==$season->id)?'selected':'' }}>
                {{ $season->name }}
            </option>
        @endforeach
    </select>

    <!-- Размер -->
    <select name="size" class="border p-2 rounded">
        <option value="">Все размеры</option>
        @foreach($sizes as $size)
            <option value="{{ $size->id }}" {{ (isset($filters['size']) && $filters['size']==$size->id)?'selected':'' }}>
                {{ $size->name }}
            </option>
        @endforeach
    </select>

    <!-- Пол -->
    <select name="gender" class="border p-2 rounded">
        <option value="">Все полы</option>
        @foreach(['man','woman','boy','girl','unisex'] as $gender)
            <option value="{{ $gender }}" {{ (isset($filters['gender']) && $filters['gender']==$gender)?'selected':'' }}>
                {{ ucfirst($gender) }}
            </option>
        @endforeach
    </select>

    <!-- Цена -->
    <input type="number" name="price_min" placeholder="Мин цена" class="border p-2 rounded w-24" value="{{ $filters['price_min'] ?? '' }}">
    <input type="number" name="price_max" placeholder="Макс цена" class="border p-2 rounded w-24" value="{{ $filters['price_max'] ?? '' }}">

    <!-- Кнопки -->
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Применить</button>
    <a href="{{ route('client.home') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Очистить</a>

</form>
