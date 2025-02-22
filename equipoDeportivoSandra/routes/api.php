<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/events',[EventApiController::class,'index']);
Route::get('/events/{event}',[EventApiController::class,'show']);
Route::put('/events/{event}', [EventApiController::class, 'update'])->name('update');
Route::delete('/events/{event}', [EventApiController::class, 'destroy']);
