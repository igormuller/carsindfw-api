<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Services\GoogleService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getLatLngMapsGoogle(Request $request)
    {
        $request->validate(['address_id' => 'required|integer|exists:addresses,id']);
        $address = Address::find($request->address_id);
        $service = new GoogleService();
        return $service->getLatLng($address);
    }
}
