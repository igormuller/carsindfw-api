<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'days',
        'trial_period_days',
        'value',
        'company_type',
        'active',
        'stripe_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
