<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/dashboard-example', function () {
    return view('dashboard.index-example');
})->name('dashboard 2');