<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sale extends Controller
{
    public function index()
    {
        return view('sale');
    }
}