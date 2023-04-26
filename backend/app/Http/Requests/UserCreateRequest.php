<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\FailedValidation;
use Illuminate\Validation\Rules\Password;

class UserCreateRequest extends FormRequest
{
    // use FailedValidation;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(4)],
            'zipcode' => ['required', 'max:255'],
            'role_id' => ['required', 'integer'],
            'garanty' => ['string', 'max:255'],
        ];
    }
}
