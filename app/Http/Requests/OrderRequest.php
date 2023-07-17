<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'table_id' => [
                'required',
                'exists:tables,id'
            ],
            'reservation_id' => [
                'required',
                'exists:reservations,id'
            ],

        ];
    }
}
