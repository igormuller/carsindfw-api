<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $fillable = ['make_id','name'];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
    public function make()
    {
        return $this->belongsTo("App\Models\Make");
    }

    //------------------------------//
    //          SCOPES              //
    //------------------------------//


    //------------------------------//
    //          FUNCTIONS           //
    //------------------------------//
    public function getName(): string
    {
        return $this->name;
    }
}
