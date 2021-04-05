<?php

namespace App\Models;

use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dealer extends Model
{
    use SoftDeletes, CompanyTrait;

    protected $fillable = [
        'company_id',
        'broker_id',
        'name',
        'document',
        'phone',
        'email',
        'site',
        'instagram',
        'facebook',
        'profile_path',
    ];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
    public function company()
    {
        return $this->belongsTo("App\Models\Company");
    }

    public function broker()
    {
        return $this->belongsTo("App\Models\Broker");
    }

    public function address()
    {
        return $this->hasOne('App\Models\Address','company_id','company_id');
    }

    public function advertisements()
    {
        return $this->hasMany('App\Models\Advertisement','company_id','company_id');
    }

    public function gallery()
    {
        return $this->hasMany("App\Models\GalleryDealer");
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
        if (empty($this->email)) {
            return $this->users->first()->email;
        }
        return $this->email;
    }
}
