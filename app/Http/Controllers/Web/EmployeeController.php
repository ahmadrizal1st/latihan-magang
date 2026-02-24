<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{

    public function index()
    {
        return view('employees.index');
    }
}