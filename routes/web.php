<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// New added route
Route::view('syd-assign', 'syd-assign');
