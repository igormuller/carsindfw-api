<?php

namespace App\Models;

use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use CompanyTrait;

    protected $fillable = [
        'company_id',
        'country',
        'state_id',
        'city_id',
        'neighborhood',
        'street',
        'number',
        'compements',
        'zipcode',
    ];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
    public function company()
    {
        return $this->belongsTo("App\Models\Company");
    }

    public function city()
    {
        return $this->belongsTo("App\Models\City");
    }

    public function state()
    {
        return $this->belongsTo("App\Models\State");
    }

    //------------------------------//
    //          SCOPES              //
    //------------------------------//


    //------------------------------//
    //          FUNCTIONS           //
    //------------------------------//
}
