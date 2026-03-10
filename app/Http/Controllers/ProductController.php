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

        $viewedIds = session()->get('viewed')??[];
        array_unshift($viewedIds, $product->id);
        session()->put('viewed', array_slice($viewedIds, 0, 3));

        $recommended = $recommendationService->getRecommendations($viewedIds);
        return view('product.show', compact('product', 'recommended'));
    }
}
