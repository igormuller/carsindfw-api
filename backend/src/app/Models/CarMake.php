<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarMake extends Model
{
    protected $fillable = ['name'];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
    public function advertisements()
    {
        return $this->hasMany("App\Models\Advertisement");
    }

    public function getModels()
    {
        return $this->hasMany("App\Models\Model");
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
