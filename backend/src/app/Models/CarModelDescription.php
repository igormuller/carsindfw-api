<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModelDescription extends Model
{
    protected $fillable = [
        'car_model_id',
        'id_teolida',
        'trim',
        'year',
        'body_type_id',
        'seats',
        'cylinder',
        'cylinder_type',
        'engine_size',
        'horsepower',
        'drive_type',
        'transmission',
        'transmission_type',
        'fuel_type',
        'epa_mileage_city',
        'epa_mileage_street'
    ];

    public function bodyType()
    {
        return $this->belongsTo("App\Models\BodyType");
    }
}
