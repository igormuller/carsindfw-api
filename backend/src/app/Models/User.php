<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'password',
        'profile_path',
        'email_virified_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
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
    public function scopeThisCompany($query)
    {
        return $query->where('company_id', Auth::user()->company_id);
    }

    //------------------------------//
    //          FUNCTIONS           //
    //------------------------------//
    public function getInfoCompany()
    {
        $type_company = $this->company->type;
        $type = $this->company->$type_company->toArray();
        $type['type'] = $type_company;
        return $type;
    }
}
