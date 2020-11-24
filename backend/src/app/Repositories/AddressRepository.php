<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository extends BaseRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Address();
    }
}
