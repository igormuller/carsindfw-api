<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['state_id', 'name', 'county_name'];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
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
