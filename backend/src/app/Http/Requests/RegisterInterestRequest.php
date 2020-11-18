<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterInterestRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'        => 'required',
            'phone'       => 'required_without:email|max:20',
            'email'       => 'required_without:phone|email',
            'copy'        => 'boolean',
            'description' => 'required',
        ];
    }
}
