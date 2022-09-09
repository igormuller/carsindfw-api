<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedAdvertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertisement_id',
        'expires_in',
    ];

    protected $casts = [
        'expires_in' => 'datetime',
    ];

    //------------------------------//
    //          RELATIONS           //
    //------------------------------//
    public function advertisement()
    {
        return $this->belongsTo("App\Models\Advertisement");
    }

}
