<?php

namespace App\Repositories;

use App\Models\Broker;

class BrokerRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Broker();
    }

    public function create(Array $data): Broker
    {
        return $this->entity->create($data);
    }
}
