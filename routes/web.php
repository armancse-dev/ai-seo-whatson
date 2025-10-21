<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeywordController;

Route::post('/cluster-keywords', [KeywordController::class, 'cluster']);

Route::get('/', function () {
    return view('welcome');
});
