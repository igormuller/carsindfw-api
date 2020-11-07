<?php

namespace App\Http\Controllers;

use App\Services\Zipcode\ZipcodeService;

class ZipcodeController extends Controller
{
    public function search($number)
    {
        if (strlen($number) !== 5) {
            return response(['Zipcode need 5 length!!'], 422);
        }
        $service = new ZipcodeService();
        $zipcode = $service->searchZipcode($number);
        if (empty($zipcode)) {
            return response(['errors' =>['zipcode'=>['Zipcode not found']]], 422);
        }
        return $zipcode;
    }
}
