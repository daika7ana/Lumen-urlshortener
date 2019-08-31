<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request): View
    {
        return view('shortener.index');
    }
}
