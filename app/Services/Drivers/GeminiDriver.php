<?php

namespace App\Services\Drivers;

use App\Contracts\RecommendationDriver;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GeminiDriver implements RecommendationDriver
{
    public function recommend(Collection $viewedProducts, Collection $allProducts): Collection
    {
        $prompt = "Based on these viewed products:\n";
        foreach ($viewedProducts as $vp) {
            $prompt .= "- {$vp->name}: {$vp->description}\n";
        }
        $prompt .= "\nFrom this product list:\n";
        $prompt .= $allProducts->pluck('name')->implode(", ");
        $prompt .= "\nSuggest 3 similar products. Return ONLY the product names, one per line, no extra text.";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-goog-api-key' => env('GEMINI_API_KEY'),
            ])->withOptions([
                'verify' => config('app.env') === 'production',
            ])->post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent',
                [
                    'contents' => [[
                        'parts' => [[ 'text' => $prompt ]]
                    ]]
                ]
            );
            $text = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';
            $lines = preg_split('/\r\n|\r|\n/', $text);

            $names = collect($lines)->map(function ($line) {
                $line = preg_replace('/^\d+\.\s*/', '', $line);
                return trim($line, "* \t\n\r\0\x0B");
            })->filter();

            return $allProducts->whereIn('name', $names)->take(3);
        } catch (\Exception $e) {
            dd($e);
            return $allProducts->random(3);
        }
    }
}
