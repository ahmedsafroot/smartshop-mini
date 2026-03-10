<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Http;

class RecommendationService
{
    //integrated with Gemini
    public function getRecommendations($viewedIds)
    {
        // Fetch the actual product models
        $viewedProducts = Product::whereIn('id', $viewedIds)->get();
        $prompt = "Based on these viewed products:\n";
        foreach ($viewedProducts as $vp) {
            $prompt .= "- {$vp->name}: {$vp->description}\n";
        }
        $prompt .= "\nFrom this product list:\n";
        $prompt .= Product::pluck('name')->implode(", ");
        $prompt .= "\nSuggest 3 similar products. Return ONLY the product names, one per line, no extra text.";


        try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'X-goog-api-key' => env('GEMINI_API_KEY'),
                ])->withOptions([
                    'verify' => config('app.env')==='production', // bypass SSL verification locally
                ])->post(
                    'https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent',
                    [
                        'contents' => [[
                            'parts' => [[ 'text' => $prompt ]]
                        ]]
                    ]
                );
            $text = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';

            // Split into lines
            $lines = preg_split('/\r\n|\r|\n/', $text);

            // Clean each line
            $names = collect($lines)->map(function ($line) {
                // Remove numbering and markdown
                $line = preg_replace('/^\d+\.\s*/', '', $line);
                $line = trim($line, "* \t\n\r\0\x0B");
                return $line;
            })->filter()->toArray();

            return Product::whereIn('name', $names)->take(3)->get();
        } catch (\Exception $e) {
            return Product::inRandomOrder()->take(3)->get();
        }
    }
}
