<?php

namespace App\Http\Controllers\Elements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function show()
    {
        return view('elements.header');
    }

    public function showMobile()
    {
        return view('elements.header');
    }
}
