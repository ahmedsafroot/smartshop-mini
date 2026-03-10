<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\RecommendationService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(RecommendationService $recommendationService): View
    {
        $products = Product::take(20)->get();
        $viewed = session()->get('viewed')??[];
        $recommended = $recommendationService->getRecommendations($viewed);
        return view('home', compact('products', 'recommended'));
    }
}
