<?php

namespace App\Services\Broker;

use App\Models\Broker;
use App\Repositories\BrokerRepository;

class BrokerService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new BrokerRepository();
    }

    public function create(array $data) : Broker
    {
        return $this->repository->create($data);
    }
}
