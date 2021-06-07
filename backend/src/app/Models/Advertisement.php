<?php

namespace App\Models;

use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use CompanyTrait, SoftDeletes;

    protected $fillable = [
        "company_id",
        "car_make_id",
        "car_model_id",
        "car_model_description_id",
        "type",
        "year",
        "trim",
        "body_type",
        "transmission",
        "transmission_type",
        "engine",
        "drive_type",
        "fuel_type",
        "seats",
        "doors",
        "color_ext",
        "color_int",
        "vin_number",
        "miles",
        "features",
        "value",
        "description"
    ];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
    public function company()
    {
        return $this->belongsTo("App\Models\Company");
    }

    public function dealer()
    {
        return $this->belongsTo("App\Models\Dealer", 'company_id');
    }

    public function carMake()
    {
        return $this->belongsTo("App\Models\CarMake");
    }

    public function carModel()
    {
        return $this->belongsTo("App\Models\CarModel");
    }

    public function carDescription()
    {
        return $this->belongsTo("App\Models\CarModelDescription", 'car_model_description_id');
    }

    public function gallery()
    {
        return $this->hasMany("App\Models\GalleryAdvertisement");
    }

    //------------------------------//
    //          SCOPES              //
    //------------------------------//


    //------------------------------//
    //          FUNCTIONS           //
    //------------------------------//
}
