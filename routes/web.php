<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('log_in');
});
Route::get('/home', function () {
    return view('home');
});
