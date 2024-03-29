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

    public function address()
    {
        return $this->hasOne('App\Models\Address','company_id','company_id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'company_id', 'company_id');
    }

    //------------------------------//
    //          SCOPES              //
    //------------------------------//


    //------------------------------//
    //          FUNCTIONS           //
    //------------------------------//
    public function getEmailToSend() : string
    {
        return $this->users->first()->email;
    }
}
