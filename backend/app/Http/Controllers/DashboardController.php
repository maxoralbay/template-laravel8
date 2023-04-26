<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard', [
            'latestUsers' => User::withCount('equipments')->orderBy('created_at', 'desc')->get()
        ]);
    }
}
