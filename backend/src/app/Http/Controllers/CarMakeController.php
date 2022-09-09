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
                    $carMake        = $serviceCar->findOrCreateMake($data);
                    $carModel       = $serviceCar->findOrCreateModel($data, $carMake);
                    $bodyType       = $serviceCar->findOrCreateBodyType($data);
                    $carDescription = $serviceCar->updateOrCreateDescription($data, $carModel, $bodyType);
                } catch (\Exception $e) {
                    Log::info("row(".$i.") - data".json_encode($data));
                    Log::error($e->getMessage());
                    Log::error('Line : ' .$e->getLine().' Archive: '.$e->getFile());
                }

                if (($i % 1000) === 0) Log::info("row(".$i.")");

                $i++;
            }
            Log::info("fim");
        }
    }
}

