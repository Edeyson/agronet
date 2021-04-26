<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'data.attributes.nombre' => ['required', 'string', 'max:255'],
            'data.attributes.apellido' => ['required', 'string', 'max:255'],
            'data.attributes.email' => ['required', 'string','email', 'max:255', 'unique:registered_users,email'],
            'data.attributes.password' => ['required', 'string', 'min:8'],
            'data.attributes.departamento' => ['required', 'string', 'max:255'],
            'data.attributes.ciudad' => ['required', 'string', 'max:255'],
            'data.attributes.telefono' => ['required', 'string', 'max:255'],
            'data.attributes.nameToken' => ['required']

        ];
    }
}
