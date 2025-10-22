<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeywordController;


Route::post('/cluster-keywords', [KeywordController::class, 'cluster']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/api/test', function () {
    return response()->json([
        'message' => 'Connected successfully to Laravel API!',
        'data' => ['SEO', 'AI', 'Tools', 'Laravel', 'React']
    ]);
});