<?php

namespace App\Services\Zipcode;

use App\Models\Zipcode;
use App\Repositories\ZipcodeRepository;

class ZipcodeService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ZipcodeRepository();
    }

    public function searchZipcode(string $number) :? Zipcode
    {
        $zipcode = $this->repository->searchZipcode($number);
        return !empty($zipcode) ? $zipcode->load('city.state') : $zipcode;
    }
}
