<?php
namespace App\Contracts;

use Illuminate\Support\Collection;

interface RecommendationDriver
{
    public function recommend(Collection $viewedProducts, Collection $allProducts): Collection;
}
