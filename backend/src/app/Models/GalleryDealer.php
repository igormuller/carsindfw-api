<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryDealer extends Model
{
    protected $fillable = [
        'dealer_id',
        'name',
        'path',
        'description',
    ];
}
