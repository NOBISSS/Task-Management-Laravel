<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Authentication.Signin');
});

Route::get('/signup', function () {
    return view('Authentication.Signup');
})->name('signup');

Route::get('/signin', function () {
    return view('Authentication.Signin');
})->name('signin');

// Placeholder POST routes (wire these to your AuthController later)
Route::post('/signin/{user}', function ($user) {
    // TODO: handle login
    echo "Login POST route hit for user: $user. Implement login logic here.";
})->name('signin.post');  

Route::post('/register', function () {
    // TODO: handle register
    echo "Register POST route hit. Implement registration logic here.";
})->name('register.post');

// Password reset (prevents route() errors in blade if Route::has() check is used)
Route::get('/forgot-password', function () {
    // TODO: forgot password view
})->name('password.request');