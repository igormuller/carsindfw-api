<?php

namespace App\Repositories;

use App\Models\Person;

class PersonRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Person();
    }

    public function create(Array $data): Person
    {
        return $this->entity->create($data);
    }
}
