<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'advertisement_id',
        'name',
        'path',
        'description',
    ];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
    public function advertisement()
    {
        return $this->belongsTo("App\Models\Advertisement");
    }

    //------------------------------//
    //          SCOPES              //
    //------------------------------//


    //------------------------------//
    //          FUNCTIONS           //
    //------------------------------//
}
