<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StatusController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/status/{nim}', [StatusController::class, 'checkStatus']);
Route::get('/ukm', [StatusController::class, 'getUkmList']);
Route::get('/prestasi', [StatusController::class, 'getPrestasi']);
