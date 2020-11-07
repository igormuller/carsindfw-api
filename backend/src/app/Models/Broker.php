<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'document',
        'phone',
    ];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
    public function company()
    {
        return $this->belongsTo("App\Models\Company");
    }

    //------------------------------//
    //          SCOPES              //
    //------------------------------//


    //------------------------------//
    //          FUNCTIONS           //
    //------------------------------//
}
