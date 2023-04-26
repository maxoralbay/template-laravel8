<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\Auth\LogoutResource;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return new LogoutResource(null);
    }
}
