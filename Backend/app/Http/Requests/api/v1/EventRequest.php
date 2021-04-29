<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'data.attributes.producer_id' => ['required', 'exists:producers,id'],
            'data.attributes.addr_id' => ['required', 'numeric', 'exists:addrs,id'],
            'data.attributes.fecha' => ['required', 'string', 'max:255'],
            'data.attributes.hora' => ['required', 'string', 'max:255'],
            'data.attributes.duracion' => ['required', 'numeric']
        ];
    }
}
