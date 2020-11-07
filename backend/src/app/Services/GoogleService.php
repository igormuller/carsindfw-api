<?php

namespace App\Services;

use App\Models\Address;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class GoogleService
{
    private $client;
    private $key;
    private $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=';

    public function __construct()
    {
        $this->client = new Client();
        $this->key = env('MAPS_KEY');
    }

    public function getLatLng(Address $address) : array
    {
        $data = [
            'center' => [
                'lat' => 31.9685988,
                'lng' => -99.9018131,
            ],
            'zoom'   => 6,
        ];
        $addressSearch = $address->street.'+'.$address->number.'+'.$address->city->name.'+'.$address->state->initials.'+'.$address->zipcode;
        $url = $this->url . $addressSearch . '&key=' . $this->key;
        $response = $this->client->request('get', $url);
        if ($response->getStatusCode() === 200) {
            $response = json_decode($response->getBody());
            $response = $response->results[0];

            $data = [
                'center' => $response->geometry->location,
                'zoom'   => !empty($address->street) ? 18 : 12,
            ];
        }
        return $data;
    }
}
