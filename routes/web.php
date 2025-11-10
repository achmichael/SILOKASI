<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home-premium');
});

Route::get('/criteria', function () {
    return view('criteria');
});

Route::get('/alternatives', function () {
    return view('alternatives');
});

Route::get('/results', function () {
    return view('results');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});
