<?php

namespace App\Models;

use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use CompanyTrait;

    protected $fillable = [
        'company_id',
        'started_at',
        'finished_at',
        'status',
        'plan_type_id',
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
