<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class PostalCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('regions.postal-codes.index');
    }
}