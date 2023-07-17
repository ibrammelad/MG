<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_id' => [
                'required',
                'exists:customers,id'
            ],
            'from_time' => [
                'required',
                'date_format:H:i'
            ],
            'to_time' => [
                'required',
                'date_format:H:i',
                'after:start_time'
            ]
        ];
    }
}
