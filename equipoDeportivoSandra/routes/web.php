<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('politics',function(){
    return view('legal.politics'); // preguntar
})->name('politics');

Route::get('useTerms',function(){
    return view('legal.useTerms');
})->name('useTerms');

Route::get('contact',function(){
    return view('legal.useTerms');
})->name('useTerms');

// esta es de js
Route::get('/eventos',function(){
    return view('eventos');
});

Route::get('events', function(){
    return view('events.show');
})->name('events');

Route::get('location', function(){
    return view('contactInfo.location');
})->name('location');

Route::resource('players', PlayerController::class);
Route::resource('events', EventController::class);
Route::resource('messages', MessageController::class);


