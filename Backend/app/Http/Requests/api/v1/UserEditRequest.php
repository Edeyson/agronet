<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'data.attributes.nombre' => ['nullable', 'string', 'max:255'],
            'data.attributes.apellido' => ['nullable', 'string', 'max:255'],            
            'data.attributes.password' => ['nullable', 'string', 'min:8'],
            'data.attributes.departamento' => ['required', 'string', 'max:255'],
            'data.attributes.ciudad' => ['nullable', 'string', 'max:255'],
            'data.attributes.telefono' => ['nullable', 'string', 'max:255']           

        ];
    }
}
