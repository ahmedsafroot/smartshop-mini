@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold">Your Cart</h1>

    @foreach($cart as $id => $item)
        <div class="flex justify-between items-center border p-4">
            <span>{{ $item['name'] }} - ${{ $item['price'] }}</span>
            <form method="POST" action="{{ route('cart.update', $id) }}">
                @csrf
                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                       class="border p-1 w-16">
                <button type="submit" class="ml-2 bg-gray-200 px-2">Update</button>
            </form>
        </div>
    @endforeach

    <form method="POST" action="{{ route('cart.checkout') }}" class="mt-6">
        @csrf
        <button type="submit" class="bg-green-500 text-white px-4 py-2">Checkout</button>
    </form>

    @if(session('success'))
        <p class="mt-4 text-green-600">{{ session('success') }}</p>
    @endif
@endsection
