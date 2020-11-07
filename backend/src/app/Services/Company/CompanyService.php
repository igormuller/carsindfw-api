<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Repositories\AddressRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\UserRepository;
use App\Services\Broker\BrokerService;
use App\Services\Dealer\DealerService;
use App\Services\Person\PersonService;
use App\Services\Plan\AdminPlanService;

class CompanyService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new CompanyRepository();
    }

    public function detail(Company $company)
    {
        return $this->repository->getDetailShow($company);
    }
}
