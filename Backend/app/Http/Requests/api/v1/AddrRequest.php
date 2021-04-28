<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class AddrRequest extends FormRequest
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
            'data.attributes.registered_user_id' => ['required', 'exists:registered_users,id'],
            'data.attributes.country' => ['required', 'string', 'max:255'],
            'data.attributes.province' => ['required', 'string', 'max:255'],
            'data.attributes.city' => ['required', 'string', 'max:255'],
            'data.attributes.street' => ['required', 'string', 'max:255'],
            'data.attributes.location' => ['nullable', 'string', 'max:255'],
            'data.attributes.etiqueta' => ['required', 'string', 'max:255']
        ];
    }
}
