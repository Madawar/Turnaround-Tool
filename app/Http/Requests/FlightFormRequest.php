<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightFormRequest extends FormRequest
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

            'carrier' => 'required',
            'flightNo' => 'required|min:3',
            'orig' => 'required:size:3',
            'dest' => 'required:size:3',
            'flightType' => 'required:size:1',
            'aircraftType' => 'required',
            'aircraftRegistration' => 'required',
            'turnaroundType' => 'required',
            'flightDate' => 'required|date',
            'departure' => 'date|after:arrival|nullable',
            'arrival' => 'date|nullable',
            'STD' => 'required|date|after:STA',
            'STA' => 'required|date',
        ];
    }
}
