<?php

namespace App\Services\General;

use App\Models\BodyType;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarModelDescription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateCarService
{
    const TRANSMISSION_TYPE = [
        'speed manual'                          => 'manual',
        'speed automatic'                       => 'automatic',
        'speed'                                 => 'automatic',
        'continuously variable-speed automatic' => 'cvt',
        'electrically variable-speed automatic' => 'evt',
        'speed direct drive'                    => 'direct_drive',
        'speed shiftable automatic'             => 'shiftable_automatic',
        'speed automated manual'                => 'automated_manual',
    ];

    const FUEL_TYPE = [
        'diesel'               => 'diesel',
        'electric'             => 'electric',
        'electric (fuel cell)' => 'electric',
        'flex-fuel (FFV)'      => 'flex_fuel',
        'gas'                  => 'gas',
        'hybrid'               => 'hybrid',
        'natural gas (CNG)'    => 'natural_gas',
    ];

    const DRIVE_TYPE = [
        'all wheel drive'   => 'AWD',
        'four wheel drive'  => '4WD',
        'front wheel drive' => 'FWD',
        'rear wheel drive'  => 'RWD',
    ];


    public function findOrCreateMake(array $data)
    {
        return CarMake::firstOrCreate(['name' => $data[1]]);
    }

    public function findOrCreateModel($data, $carMake)
    {
        return CarModel::firstOrCreate(
            [
                'car_make_id' => $carMake->id,
                'name'        => $data[2],
            ]
        );
    }

    public function findOrCreateBodyType($data)
    {
        if (empty($data[5])) return null;

        return BodyType::firstOrCreate(
            [
                'name' => $data[5],
                'slug' => Str::lower(Str::slug($data[5]))
            ]
        );
    }

    public function updateOrCreateDescription($data, $carModel, $bodyType)
    {
        $transmission = $this->extractTransmission($data);
        $fuelType     = $this->extractFuelType($data);
        $epaMilage    = $this->extractEpaMilage($data);
        $engine       = $this->extractEngine($data);
        $cylinder = $this->extractCylinder($data);

        return CarModelDescription::updateOrCreate(
            [
                'id_teolida'   => $data[0],
            ],[
                'car_model_id'       => $carModel->id,
                'trim'               => $data[4],
                'year'               => $data[3],
                'body_type_id'       => !empty($bodyType) ? $bodyType->id : null,
                'seats'              => !empty($data[6]) ? $data[6] : null,
                'cylinder'           => $cylinder['cylinder'],
                'cylinder_type'      => $cylinder['cylinder_type'],
                'engine_size'        => $engine,
                'horsepower'         => !empty($data[9]) ? $data[9] : null,
                'drive_type'         => !empty($data[11]) ? self::DRIVE_TYPE[$data[11]] : null,
                'transmission'       => $transmission['transmission'],
                'transmission_type'  => $transmission['transmission_type'],
                'fuel_type'          => $fuelType,
                'epa_mileage_city'   => $epaMilage['city'],
                'epa_mileage_street' => $epaMilage['highway'],
            ]
        );
    }

    private function extractTransmission($data)
    {
        if (empty($data[12])) return ['transmission' => null, 'transmission_type' => null];

        $aux = explode('-', $data[12]);
        return [
            'transmission'      => is_numeric($aux[0]) ? $aux[0] : null,
            'transmission_type' => self::TRANSMISSION_TYPE[$aux[1]],
        ];
    }

    private function extractFuelType($data)
    {
        return !empty($data[13]) ? self::FUEL_TYPE[$data[13]] : null;
    }

    private function extractEpaMilage($data)
    {
        if (empty($data[14])) return ['city' => null, 'highway' => null];

        $auxEpa = explode('/', $data[14]);
        return [
            'city' => $auxEpa[0],
            'highway' => explode(' ', $auxEpa[1])[0]
        ];
    }

    private function extractEngine($data)
    {
        if (empty($data[8])) return null;

        $engine = str_replace(',', '.', $data[8]);
        $engineAux = explode(' ', $engine);
        if (sizeof($engineAux) > 1) {
            $engine = $engineAux[0];
        }
        return $engine;
    }

    private function extractCylinder($data)
    {
        if (empty($data[7])) return ['cylinder' => null, 'cylinder_type' => null];
        return [
            'cylinder'      => preg_replace("/[^\d]/", "", $data[7]),
            'cylinder_type' => trim(preg_replace("/[\d]/", "", $data[7])),
        ];
    }
}
