<?php

namespace App\Services;

use App\Contracts\RecommendationDriver;
use App\Models\Product;
use Illuminate\Support\Collection;

class RecommendationService
{
    protected RecommendationDriver $driver;

    public function __construct(RecommendationDriver $driver)
    {
        $this->driver = $driver;
    }

    public function getRecommendations(array $viewedIds): Collection
    {
        $viewedProducts = Product::whereIn('id', $viewedIds)->get();
        $allProducts = Product::all();

        if ($viewedProducts->isEmpty()) {
            return $allProducts->random(3);
        }
        return $this->driver->recommend($viewedProducts, $allProducts);
    }
}
