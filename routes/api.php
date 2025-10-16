<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SeoAuditController;

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function(){ return auth()->user(); });
    Route::apiResource('projects', ProjectController::class);
    Route::post('projects/{project}/audit', [SeoAuditController::class,'run']);
    Route::get('projects/{project}/reports', [SeoAuditController::class,'reports']);
});
