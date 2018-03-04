<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index()
    {
        return view('shortener.index');
    }
}
