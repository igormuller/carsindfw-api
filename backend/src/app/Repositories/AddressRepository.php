<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Address();
    }

    public function create(Array $data): Address
    {
        return $this->entity->create($data);
    }
}
