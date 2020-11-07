<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    protected $fillable = ['city_id', 'number'];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
    public function city()
    {
        return $this->belongsTo("App\Models\City");
    }

    //------------------------------//
    //          SCOPES              //
    //------------------------------//


    //------------------------------//
    //          FUNCTIONS           //
    //------------------------------//
}
