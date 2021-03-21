<?php

namespace App\Models;

use App\Traits\CompanyTrait;
use Carbon\Carbon;
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

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
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
    public function detail()
    {
        $this->started_date = Carbon::make($this->started_at)->format('Y-m-d');
        $this->finished_date = Carbon::make($this->finished_at)->format('Y-m-d');
        return $this;
    }
}
