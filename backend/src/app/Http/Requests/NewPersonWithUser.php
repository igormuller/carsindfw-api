<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPersonWithUser extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'name'     => 'required|string',
            'document' => 'required|string|min:11|max:16',
            'phone'    => 'nullable|string|max:15',
            'email'    => 'required|unique:users',
            'password' => 'required|min:6',
        ];
    }
}
