<?php

use App\Http\Controllers\MasterData\PostCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'master'], function ($route) {
    $route->apiResource('post-category', PostCategoryController::class);
});
