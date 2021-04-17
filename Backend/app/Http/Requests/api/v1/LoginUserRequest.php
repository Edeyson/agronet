<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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

            'data' => ['required', 'array'],
            'data.type' => ['required'],
            'data.attributes' => ['required', 'array'],
            'data.attributes.email' => ['required', 'email', 'max:255'],
            'data.attributes.password' => ['required', 'string', 'max:255'],
            'data.attributes.nameToken' => ['required', 'string', 'max:255']
        ];
    }
}
