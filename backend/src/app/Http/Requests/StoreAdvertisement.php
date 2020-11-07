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
            "car_make_id" => "required|exists:car_makes,id",
            "car_model_id" => "required|exists:car_models,id",
            "type" => "required|in:new,used",
            "year" => "required",
            "trim" => "required",
            "body_type" => "required|in:convertible,coupe,hatchback,minivan,sedan,suv,truck,van,wagon",
            "transmission" => "nullable|integer",
            "transmission_type" => "nullable|in:manual,automatic,cvt,evt,direct_drive,shiftable_automatic,automated_manual",
            "drive_type" => "nullable|in:AWD,4WD,FWD,RWD",
            "fuel_type" => "nullable|in:gas,diesel,electric,hybrid,flex_fuel,natural_gas",
            "color_ext" => "required",
            "color_int" => "nullable",
            "engine" => "required",
            "seats" => "nullable|integer",
            "doors" => "nullable|integer",
            "vin_number" => "required",
            "miles" => "required",
            "features" => "nullable",
            "value" => "required",
            "description" => "nullable"
        ];
    }
}
