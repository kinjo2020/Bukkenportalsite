<?php

namespace App\Http\Controllers\Estate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:estate');
    }
    
    public function index()
    {
        return view('estate.home');
    }
}
