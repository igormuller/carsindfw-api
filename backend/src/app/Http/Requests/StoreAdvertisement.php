<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvertisement extends FormRequest
{
    public function authorize()
    {
        return true;
    }

   public function rules()
    {
        return [
            "car_make_id"              => "required|exists:car_makes,id",
            "car_model_id"             => "required|exists:car_models,id",
            "car_model_description_id" => "required|exists:car_model_descriptions,id",
            "type"                     => "required|in:new,used",
            "color_ext"                => "required",
            "color_int"                => "nullable",
            "doors"                    => "nullable|integer",
            "vin_number"               => "required|min:17|max:19",
            "miles"                    => "required",
            "features"                 => "nullable",
            "value"                    => "required",
            "description"              => "nullable",
        ];
    }
}
