<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentCreateRequest extends FormRequest
{
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
            'equipment_category_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'serial_number' => ['required', 'max:255'],
            'buy_date' => ['required', 'string'],
            'documents.*' => ['required', 'file']
        ];
    }
}
