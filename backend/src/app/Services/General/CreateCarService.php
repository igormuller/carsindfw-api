<?php

namespace App\Services\General;

use App\Enums\EnumCarModelDescription;
use App\Enums\TypeEnum;
use App\Models\BodyType;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarModelDescription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateCarService
{
    private $carMakes;

    public function __construct()
    {
        $this->carMakes = CarMake::all();
    }

    public function findMake(array $data)
    {
        $carMake = $this->carMakes->where('name', $data[1])->first();
        if (empty($carMake)) {
            $newCarMake = new CarMake();
            $newCarMake->name = $data[1];
            $newCarMake->save();
            return $newCarMake;
        }
        return $carMake;
    }

    public function findModel($data, $carMake)
    {
        return CarModel::firstOrCreate(
            [
                'car_make_id' => $carMake->id,
                'name'        => $data[2],
            ]
        );
    }

    public function findBodyType($data)
    {
        return BodyType::firstOrCreate(
            [
                'name' => $data[5],
                'slug' => Str::lower(Str::slug($data[5]))
            ]
        );
    }

    public function findDescription($data, $carModel, $bodyType)
    {
        $drive_type = [
            'all wheel drive'   => 'AWD',
            'four wheel drive'  => '4WD',
            'front wheel drive' => 'FWD',
            'rear wheel drive'  => 'RWD',
        ];

        $fuel_type = [
            'diesel'               => 'diesel',
            'electric'             => 'electric',
            'electric (fuel cell)' => 'electric',
            'flex-fuel (FFV)'      => 'flex_fuel',
            'gas'                  => 'gas',
            'hybrid'               => 'hybrid',
            'natural gas (CNG)'    => 'natural_gas',
        ];

        $transmission_type = [
            null => null,
            'speed manual' => 'manual',
            'speed automatic' => 'automatic',
            'speed' => 'automatic',
            'continuously variable-speed automatic' => 'cvt',
            'electrically variable-speed automatic' => 'evt',
            'speed direct drive' => 'direct_drive',
            'speed shiftable automatic' => 'shiftable_automatic',
            'speed automated manual' => 'automated_manual',
        ];
        $transmission = !empty($data[12]) ? explode('-', $data[12]) : [null, null];
        $epaMilage = [
            'city' => null,
            'highway' => null
        ];
        if (!empty($data[14])) {
            $auxEpa = explode('/', $data[14]);
            $epaMilage['city'] = $auxEpa[0];
            $epaMilage['highway'] = explode(' ', $auxEpa[1])[0];
        }
        $engine = null;
        if (!empty($data[8])) {
            $engine = str_replace(',', '.', $data[8]);
            $engineAux = explode(' ', $engine);
            if (sizeof($engineAux) > 1) {
                $engine = $engineAux[0];
            }
        }
        $update = [
            'car_model_id'       => $carModel->id,
            'id_teolida'         => $data[0],
            'trim'               => $data[4],
            'year'               => $data[3],
            'body_type_id'       => !empty($bodyType) ? $bodyType->id : null,
            'seats'              => !empty($data[6]) ? $data[6] : null,
            'cylinder'           => !empty($data[7]) ? preg_replace("/[^\d]/", "", $data[7]) : null,
            'cylinder_type'      => !empty($data[7]) ? trim(preg_replace("/[\d]/", "", $data[7])) : null,
            'engine_size'        => $engine,
            'horsepower'         => !empty($data[9]) ? $data[9] : null,
            'drive_type'         => !empty($data[11]) ? $drive_type[$data[11]] : null,
            'transmission'       => is_numeric($transmission[0]) ? $transmission[0] : null,
            'transmission_type'  => $transmission_type[$transmission[1]],
            'fuel_type'          => !empty($data[13]) ? $fuel_type[$data[13]] : null,
            'epa_mileage_city'   => $epaMilage['city'],
            'epa_mileage_street' => $epaMilage['highway'],
        ];
        $carDescription = CarModelDescription::where('car_model_id', $carModel->id)
                                             ->where('trim', $data[4])
                                             ->where('year', $data[3])
                                             ->get();

        if ($carDescription->isEmpty()) {
            $newCarDescription = CarModelDescription::create($update);
            return $newCarDescription;
        }

        if ($carDescription->count() === 1) {
            $carDescription = $carDescription->first();
            $carDescription->update($update);

            return $carDescription;
        }

        if ($carDescription->count() > 1) {
            $carDescription = $carDescription->first();
            $carDescription->update($update);
            Log::info('duplicate: '.$data[0]);
            return $carDescription;
        }

        return $carDescription;
    }

}
