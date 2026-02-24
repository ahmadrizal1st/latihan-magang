<?php

use App\Http\Controllers\Web\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/dashboard-example', function () {
    return view('dashboard.index-example');
})->name('dashboard 2');

Route::get('/employee', action: function () {
    return view('employees.index');
})->name('employee');

// Route::get('/employee/data', [EmployeeController::class, 'data'])
//     ->name('employee.data');