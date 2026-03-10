@extends('layouts.app')

@section('content')
    <section class="bg-gray-100 p-10 text-center">
        <h1 class="text-4xl font-bold">Welcome to SmartShop</h1>
        <p class="mt-2 text-lg">Your one-stop shop for everything!</p>
    </section>

    <!-- Search Bar -->
    <div x-data="{ query: '' }" class="p-4">
        <input type="text" x-model="query" placeholder="Search products..."
               class="border p-2 w-full">
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-4 gap-4 p-6">
        @foreach($products as $product)
            <div class="border p-4">
                <img src="/images/{{ $product->image }}" alt="{{ $product->name }}">
                <h2 class="font-bold">{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <span>${{ $product->price }}</span>
                <a href="{{ route('product.show', $product->id) }}" class="text-blue-500">View</a>
            </div>
        @endforeach
    </div>

    <!-- Recommended Section -->
    <h2 class="text-2xl font-bold p-6">Recommended for you</h2>
    <div class="grid grid-cols-3 gap-4 p-6">
        @foreach($recommended as $rec)
            <div class="border p-4">
                <img src="/images/{{ $rec->image }}" alt="{{ $rec->name }}" class="mb-2">
                <h3 class="font-bold">{{ $rec->name }}</h3>
                <p class="text-gray-600">{{ $rec->description }}</p>
                <span class="block mb-2">${{ $rec->price }}</span>

                <!-- View link -->
                <a href="{{ route('product.show', $rec->id) }}"
                   class="text-blue-500 hover:underline mr-4">
                    View
                </a>

                <!-- Add to Cart form -->
                <form action="{{ route('cart.add', $rec->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                        Add to Cart
                    </button>
                </form>
            </div>
        @endforeach
    </div>

@endsection
