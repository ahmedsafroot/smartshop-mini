<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $viewed = session()->get('viewed')??[];
        array_unshift($viewed, $product->id);
        session()->put('viewed', array_slice($viewed, 0, 3));

        $recommended = Product::inRandomOrder()->take(3)->get();

        return view('product.show', compact('product', 'recommended'));
    }
}
