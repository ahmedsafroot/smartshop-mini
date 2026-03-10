<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\RecommendationService;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function show($id,RecommendationService $recommendationService): View
    {
        $product = Product::findOrFail($id);

        $viewed = session()->get('viewed')??[];
        array_unshift($viewed, $product->id);
        session()->put('viewed', array_slice($viewed, 0, 3));

        $recommended = $recommendationService->getRecommendations($viewed);
        return view('product.show', compact('product', 'recommended'));
    }
}
