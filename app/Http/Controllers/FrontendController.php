<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class FrontendController extends Controller
{
    public function index(): View
    {
        return view('shortener.index');
    }
}
