<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryAdvertisement extends Model
{
    protected $fillable = [
        'advertisement_id',
        'name',
        'default',
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
