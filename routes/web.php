<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function () {
    return view('Authentication.Signup');
})->name('signup');

Route::get('/signin', function () {
    return view('Authentication.Signin');
})->name('signin');

// Placeholder POST routes (wire these to your AuthController later)
Route::post('/login', function () {
    // TODO: handle login
})->name('login');

Route::post('/register', function () {
    // TODO: handle register
})->name('register');

// Password reset (prevents route() errors in blade if Route::has() check is used)
Route::get('/forgot-password', function () {
    // TODO: forgot password view
})->name('password.request');