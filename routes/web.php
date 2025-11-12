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

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/decision-makers', function () {
    return view('decision-makers');
});

Route::get('/settings', function () {
    return view('settings');
});

Route::get('/criteria-comparison', function () {
    return view('criteria-comparison');
});

Route::get('/alternative-comparison', function () {
    return view('alternative-comparison');
});

Route::get('/consensus-ranking', function () {
    return view('consensus-ranking');
});
