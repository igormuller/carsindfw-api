<?php

namespace App\Repositories;

use App\Models\Plan;

class PlanRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Plan();
    }

    public function create(Array $data): Plan
    {
        return $this->entity->create($data);
    }
}
