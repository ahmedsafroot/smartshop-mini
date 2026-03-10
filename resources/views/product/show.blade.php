@extends('layouts.app')

@section('content')
    <!-- Product Detail -->
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow">
        <img src="/images/{{ $product->image }}" alt="{{ $product->name }}">

        <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
        <p class="mt-2 text-gray-600">{{ $product->description }}</p>
        <span class="block text-xl text-blue-600 font-semibold mt-3">${{ $product->price }}</span>

        <form method="POST" action="{{ route('cart.add', $product->id) }}" class="mt-4">
            @csrf
            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                Add to Cart
            </button>
        </form>
    </div>

    <!-- Recommendations -->
    <h2 class="text-2xl font-bold mt-10 mb-4 text-gray-800">You might also like</h2>
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
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                        Add to Cart
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
