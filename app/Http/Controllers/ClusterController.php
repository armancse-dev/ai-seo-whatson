<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClusterController extends Controller
{
    public function cluster(Request $request)
    {
        $keywords = $request->input('keywords', []);

        if (empty($keywords)) {
            return response()->json(['error' => 'No keywords provided'], 400);
        }

        // Dummy clustering for test
        return response()->json([
            'clusters' => [
                ['cluster_name' => 'Cluster A', 'keywords' => $keywords],
            ],
        ]);
    }
}
