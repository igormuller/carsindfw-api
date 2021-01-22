<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

   public function rules()
    {
        return [
            "name"                 => "required|max:100",
            "document"             => "max:20",
            "phone"                => "required_without:email|max:14",
            "email"                => "required_without:phone|email",
            "site"                 => "required",
            "instagram"            => "nullable",
            "facebook"             => "nullable",
            "profile_path"         => "nullable",
            "address.state_id"     => "required|exists:states,id",
            "address.city_id"      => "required|exists:cities,id",
            "address.neighborhood" => "nullable",
            "address.street"       => "required|max:100",
            "address.number"       => "required|max:10",
            "address.complements"  => "nullable|max:100",
            "address.zipcode"      => "required|max:6",
        ];
    }

    public function attributes()
    {
        return [
            "address.state_id" => "state",
            "address.city_id" => "city",
            "address.neighborhood" => "neighborhood",
            "address.street" => "street",
            "address.number" => "number",
            "address.complements" => "complements",
            "address.zipcode" => "zipcode",
        ];
    }
}
