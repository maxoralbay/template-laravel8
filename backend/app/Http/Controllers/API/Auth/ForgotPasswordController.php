<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use App\Http\Resources\System\ErrorResource;
use App\Http\Resources\System\EntityNotFoundResource;
use App\Http\Resources\System\EntityCreatedSuccessfullyResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordReset as PasswordMail;
use App\Http\Requests\ResetPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function sendPasswordResetCode($email)
    {
        if (!$user = User::where('email', $email)->first()) {
            return new EntityNotFoundResource(null);
        }

        try {
            $token = Str::random(6);
            PasswordReset::create([
                'email' => $email,
                'token' => $token
            ]);

            Mail::to($user)->send(new PasswordMail($email, $token));
        } catch (\Exception $e) {
            return new ErrorResource($e->getMessage());
        }

        return new EntityCreatedSuccessfullyResource(null);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        if (!$resetPasswordData = PasswordReset::where('token', $data['code'])->first()) {
            return new ErrorResource('Code incorrect!');
        }

        if (!$user = User::where('email', $resetPasswordData->email)->first()) {
            return new ErrorResource('L\'utilisateur est introuvable!');
        }

        if (!$user->update(['password' => $data['password']])) {
            return new ErrorResource('Erreur de réinitialisation du mot de passe!');
        }

        return new EntityCreatedSuccessfullyResource(null);
    }
}
