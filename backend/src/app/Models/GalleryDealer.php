<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryDealer extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_id',
        'name',
        'path',
        'description',
    ];
}