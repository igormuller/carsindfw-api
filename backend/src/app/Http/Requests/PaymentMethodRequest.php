<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

   public function rules()
    {
        return [
            "card_number"          => "required",
            "card_name"            => "required|max:100",
            "card_expiration_date" => "required|date_format:m/y",
            "card_cvv"             => "required|min:3|max:4",
        ];
    }

    public function messages()
    {
        return [
            'card_expiration_date.date_format' => "Date format invalid"
        ];
    }
}
