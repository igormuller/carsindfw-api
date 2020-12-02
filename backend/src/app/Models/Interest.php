<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = [
        'advertisement_id',
        'name',
        'email',
        'phone',
        'description',
        'status',
    ];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
    public function advertisement()
    {
        return $this->belongsTo("App\Models\Advertisement");
    }

    //------------------------------//
    //          SCOPES              //
    //------------------------------//


    //------------------------------//
    //          FUNCTIONS           //
    //------------------------------//
}
