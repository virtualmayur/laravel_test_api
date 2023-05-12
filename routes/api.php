<?php

use App\Http\Controllers\Api\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('countries', [CountryController::class, 'index']);
Route::post('countries', [CountryController::class, 'store']);
Route::post('countries/filter', [CountryController::class, 'filter']);
