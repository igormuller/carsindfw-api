<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\Zipcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    public function getCitiesByState($state_id)
    {
        return City::where('state_id', $state_id)->orderBy('name')->get();
    }

    public function create(Request $request)
    {
        set_time_limit(0);
//        $file = $request->file();
//        $files = Storage::get('table/cities_tratado_w_zip.csv');
//        dd($files);

        $line = 0;
        if (($handle = fopen('/var/www/storage/app/public/table/cities_tratado_w_zip.csv', 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 0, ',')) !== false)
            {
                $line++;
                if ($line === 1) {
                    continue;
                }
                $state = State::firstOrCreate(
                    [
                        'initials' => $row[1],
                    ],
                    [
                        'initials' => $row[1],
                        'name'     => $row[2],
                    ]
                );

                $city = City::create(
                    [
                        'state_id'    => $state->id,
                        'name'        => $row[0],
                        'county_name' => $row[3],
                    ]
                );

                if (!empty($row[4])) {
                    $zipcodes = explode(' ', $row[4]);
                    foreach ($zipcodes as $zipcode) {
                        Zipcode::create(
                            [
                                'city_id' => $city->id,
                                'number'  => $zipcode,
                            ]
                        );
                    }
                }
            }
            fclose($handle);
        }
    }
}
