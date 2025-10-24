<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SeoAuditController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeywordClusterController;
use App\Http\Controllers\Api\ClusterController;

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function(){ return auth()->user(); });
    Route::apiResource('projects', ProjectController::class);
    Route::post('projects/{project}/audit', [SeoAuditController::class,'run']);
    Route::get('projects/{project}/reports', [SeoAuditController::class,'reports']);
});


Route::post('/cluster', [KeywordClusterController::class, 'cluster']);