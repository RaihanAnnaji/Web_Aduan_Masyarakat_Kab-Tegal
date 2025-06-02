<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return response()->json(['message' => 'Unauthorized. Token missing.'], 401);
})->name('login');

Route::get('/', function () {
    return view('welcome');
});




