<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCompanyWithUser extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'type'         => 'required|in:person,dealer,broker',
            'first_name'   => 'required|string',
            'last_name'    => 'required|string',
            'document'     => 'required|string|min:11|unique:people',
            'phone'        => 'string|max:20',
            'email'        => 'required|unique:users',
            'zipcode'      => 'required|max:5',
            'password'     => 'required|min:6',
            're_password'  => 'required_with:password|same:password|min:6',
            'plan_type_id' => 'required|exists:plan_types,id',
        ];

        if ($this->type === 'dealer') {
            $rules_dealer = [
                'email_dealer' => 'required|email|unique:dealers,email',
                'name_dealer'  => 'required',
                'document'     => 'required|string|min:10|unique:dealers',
                'site'         => 'string|max:100',
                'instagram'    => 'string|max:100',
                'facebook'     => 'string|max:100',
            ];
            $rules = array_merge($rules, $rules_dealer);
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'email_dealer' => 'Dealer E-mail',
            'name_dealer'  => 'Dealer Name',
            'email'        => 'User E-mail',
        ];
    }
}
