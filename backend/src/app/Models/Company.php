<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'type',
        'blocked',
        'plan_type_id',
    ];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
    public function advertisement()
    {
        return $this->hasMany("App\Models\Advertisement");
    }

    public function dealer()
    {
        return $this->hasOne("App\Models\Dealer");
    }

    public function broker()
    {
        return $this->hasOne("App\Models\Broker");
    }

    public function person()
    {
        return $this->hasOne("App\Models\Person");
    }

    public function address()
    {
        return $this->hasOne("App\Models\Address");
    }

    public function plans()
    {
        return $this->hasMany("App\Models\Plan");
    }

    public function thisType()
    {
        $type = $this->type;
        return $this->$type;
    }

    //------------------------------//
    //          SCOPES              //
    //------------------------------//


    //------------------------------//
    //          FUNCTIONS           //
    //------------------------------//
    public function getAllInfo()
    {
        $data                   = $this->toArray();
        $data['company_type']   = $this->thisType();
        $data['address']        = $this->address;
        $data['plans']          = $this->plans;
        $data['advertisements'] = $this->advertisement;
        return $data;
    }
}
