<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'data' => [
                'type' => 'required',
                'attributes' => [
                    'nombre' => 'required|sring|max:255',
                    'apellido' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:8',
                    'departamento' => 'required|string|max:255',
                    'ciudad' => 'required|string|max:255',
                    'telefono' => 'required|string|max:255',
                    'nameToken' => 'required'
                ]
            ]
        ];
    }
}
