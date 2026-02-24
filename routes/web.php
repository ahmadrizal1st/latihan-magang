<?php

use App\Http\Controllers\Web\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/employee', [EmployeeController::class, 'index']);