<?php

namespace App\Services\Person;

use App\Models\Person;
use App\Repositories\PersonRepository;

class PersonService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new PersonRepository();
    }

    public function create(Array $data): Person
    {
        return $this->repository->create($data);
    }
}
