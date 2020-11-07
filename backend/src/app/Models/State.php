<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['initials', 'name'];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
    public function cities()
    {
        return $this->hasMany("App\Models\City");
    }

    //------------------------------//
    //          SCOPES              //
    //------------------------------//


    //------------------------------//
    //          FUNCTIONS           //
    //------------------------------//
}
