<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class GeoLocationRequest extends FormRequest
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
            'data.attributes.latitud' => ['required', 'numeric'],
            'data.attributes.longitud' => ['required', 'numeric'],
            'data.attributes.addr_id' => ['required', 'numeric', 'unique:geo_locations,addr_id', 'exists:addrs,id']
        ];
    }
}
