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
//            'type'                 => 'required|in:person,dealer,broker',
            'user_name'            => 'required|string',
            'user_email'           => 'required|unique:users,email|email',
            'password'             => 'required|min:6',
            're_password'          => 'required_with:password|same:password|min:6',
            'phone'                => 'string|max:14',
            'zipcode'              => 'required|max:5',
            'plan_type_id'         => 'required|exists:plan_types,id',
        ];

        if ($this->type === 'dealer') {
            $rules_dealer = [
                'name'                 => 'required',
                'document'             => 'string|min:20|unique:dealers',
                'site'                 => 'string|max:100',
                'instagram'            => 'string|max:100',
                'facebook'             => 'string|max:100',
                'card_number'          => 'required',
                'card_name'            => 'required',
                'card_expiration_date' => 'required|date_format:m/y',
                'card_cvv'             => 'required',
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
