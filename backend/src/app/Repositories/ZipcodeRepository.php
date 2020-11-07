<?php

namespace App\Repositories;

use App\Models\Zipcode;

class ZipcodeRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Zipcode();
    }

    public function searchZipcode(string $number) :? Zipcode
    {
        return Zipcode::where('number', $number)->first();
    }
}
