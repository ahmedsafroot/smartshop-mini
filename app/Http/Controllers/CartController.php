<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session()->get('cart')??[];
        $canCheckout=!empty($cart);
        return view('cart.index', compact('cart','canCheckout'));
    }

    public function add($id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart')??[];
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => ($cart[$id]['quantity'] ?? 0) + 1,
        ];
        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $cart = session()->get('cart')??[];
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }
    public function checkout(): RedirectResponse
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Order confirmed!');
    }
}
