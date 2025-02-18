<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
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
    return view('events.eventos');
})->name('eventos');


Route::get('location', function(){
    return view('contactInfo.location');
})->name('location');

Route::get('account', function(){
    return view('account.index');
})->name('account');

Route::resource('players', PlayerController::class);
Route::resource('events', EventController::class);
Route::resource('messages', MessageController::class);

Route::get('signup',[LoginController::class,'signupForm'])->name('signupForm');
Route::post('signup',[LoginController::class,'signup'])->name('signup');
Route::get('login', [LoginController::class,'loginForm'])->name('loginForm');
Route::post('login',[LoginController::class,'login'])->name('login');
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

Route::delete('/account/{id}', [LoginController::class, 'destroy'])->name('account.destroy');

