<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Models\User;
use App\Models\Role;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        User::create($request->validated());
        
        return new RegisterResource(null);
    }
}
