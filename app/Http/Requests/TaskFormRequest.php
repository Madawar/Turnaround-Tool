<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskFormRequest extends FormRequest
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
            'task'=>'required',
            'serviceId'=>'required',
            'timed'=>'required',
            'cutOffTime'=>'required_with:symbol,timeFrom',
            'symbol'=>'required_with:timeFrom,cutOffTime|in:-,*,+,/',
            'timeFrom'=>'required_with:symbol,cutOffTime'
        ];
    }
}
