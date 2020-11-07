<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

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
