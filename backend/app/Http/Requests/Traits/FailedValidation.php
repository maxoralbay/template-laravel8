<?php

namespace App\Http\Requests\Traits;

use Illuminate\Validation\ValidationException;
use App\Http\Resources\System\ValidationErrorResource;

trait FailedValidation
{
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new ValidationException(
            $validator, 
            new ValidationErrorResource($validator->errors())
        );
    }
}