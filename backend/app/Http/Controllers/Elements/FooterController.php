<?php

namespace App\Http\Controllers\Elements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function show()
    {
        return view('elements.footer');
    }
}
