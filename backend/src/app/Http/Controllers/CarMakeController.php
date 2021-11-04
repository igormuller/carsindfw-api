<?php

namespace App\Http\Controllers;

use App\Models\CarMake;
use App\Services\General\CreateCarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarMakeController extends Controller
{
    public function index()
    {
        return CarMake::all();
    }

    public function searchMakes(Request $request)
    {
        return CarMake::orWhere('name', 'LIKE', '%' . $request->make . '%')->orWhere('id', $request->make)->get();
    }

    public function processCars(Request $request)
    {
        set_time_limit(0);
        $file = $request->file('attachemnt');
        $serviceCar = new CreateCarService();

        $i = 0;
        if (($open = fopen($file, "r")) !== false) {
            while (($data = fgetcsv($open, 1000, ";")) !== false) {
                if ($i === 0) {
                    $i++;
                    continue;
                }

                try {
                    $carMake        = $serviceCar->findMake($data);
                    $carModel       = $serviceCar->findModel($data, $carMake);
                    $bodyType       = !empty($data[5]) ? $serviceCar->findBodyType($data) : null;
                    $carDescription = $serviceCar->findDescription($data, $carModel, $bodyType);
                } catch (\Exception $e) {
                    Log::info("data".json_encode($data));
                    Log::error($e->getMessage());
                }

                $i++;
            }
            Log::info("fim");
        }
    }
}

