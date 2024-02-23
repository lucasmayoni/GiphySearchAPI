<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('search', [SearchController::class, 'search']);
    Route::get('search/{id}', [SearchController::class, 'searchById']);
    Route::get('fav', [SearchController::class, 'addToFavorites']);
});


