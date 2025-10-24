<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeywordClusterController;


Route::post('/api/cluster', [KeywordClusterController::class, 'cluster']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/api/test', function () {
    return response()->json([
        'message' => 'Connected successfully to Laravel API!',
        'data' => ['SEO', 'AI', 'Tools', 'Laravel', 'React']
    ]);
});