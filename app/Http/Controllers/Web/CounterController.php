<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('counters.index');
    }
}