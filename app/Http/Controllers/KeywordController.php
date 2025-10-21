<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;

class KeywordController extends Controller
{
    public function cluster(Request $request)
    {
        // Example keywords - you can later replace with user input or DB values
        $keywords = ['wordpress speed', 'wp performance plugin', 'optimize images', 'image compression'];

        // Call the service
        $clusters = (new OpenAIService)->clusterKeywords($keywords);

        // For now, just return the clusters to check output
        return response()->json($clusters);
    }
}