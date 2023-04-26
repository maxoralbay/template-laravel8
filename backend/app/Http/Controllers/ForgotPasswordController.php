<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use App\Http\Resources\System\EntityNotFoundResource;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function resetPassword($email, $token)
    {
        
    }
}
