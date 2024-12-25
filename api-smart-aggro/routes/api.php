<?php

use App\Http\Controllers\Auth\CodeCheckController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\MasterData\PostCategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MasterData\SeasonController;
use App\Http\Controllers\MasterData\PlantRecommendationsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function ($route) {
    $route->get('google', [SocialiteController::class, 'redirectToProvider']);
    $route->get('google/callback', [SocialiteController::class, 'handleProviderCallback']);
    $route->post('register', [AuthController::class, 'register']);
    $route->post('login', [AuthController::class, 'login']);
    $route->post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    $route->post('password/email',  ForgotPasswordController::class);
    $route->post('password/code/check', CodeCheckController::class);
    $route->post('password/reset', ResetPasswordController::class);
});

Route::group(['prefix' => 'master'], function ($route) {
    $route->apiResource('post-category', PostCategoryController::class)->only(['index', 'show']);
    $route->apiResource('post-category', PostCategoryController::class)->except(['index', 'show'])->middleware('auth:sanctum');


    $route->get('season/current', [SeasonController::class, 'current_season']);
    $route->apiResource('season', SeasonController::class);

    $route->apiResource('plant-recommendations', PlantRecommendationsController::class)->only(['index', 'create', 'update']);
});

Route::apiResource('post', PostController::class)->only(['index', 'show']);
Route::apiResource('post', PostController::class)->except(['index', 'show'])->middleware('auth:sanctum');
Route::post('post/comment', [PostController::class, 'comment'])->middleware('auth:sanctum');


