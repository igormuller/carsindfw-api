<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Models\PlanType;
use App\Repositories\AddressRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\UserRepository;
use App\Services\Broker\BrokerService;
use App\Services\Dealer\DealerService;
use App\Services\Person\PersonService;
use App\Services\Plan\AdminPlanService;
use App\Services\Zipcode\ZipcodeService;

class StartCompanyService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new CompanyRepository();
    }

    public function createWithUser(Array $data): Company
    {
        $company = $this->create($data);

        $user_repository = new UserRepository();
        $data['company_id'] = $company->id;
        $data['name'] = $data['first_name']." ".$data["last_name"];
        $user_repository->create($data);

        return $company;
    }

    public function create(Array $data) : Company
    {
        $company = $this->repository->create($data);
        $data['company_id'] = $company->id;

        $this->createAddress($data);
        $this->createType($data);

        $this->startPlan($company->id, 1);

        return $company;
    }

    private function createAddress(Array $data)
    {
        $zipcodeService = new ZipcodeService();
        $zipcode = $zipcodeService->searchZipcode($data['zipcode']);
        if (!empty($zipcode)) {
            $data['city_id'] = $zipcode->city_id;
            $data['state_id'] = $zipcode->city->state_id;
        }
        $repository = new AddressRepository();
        $repository->create($data);
    }

    private function createType(Array $data)
    {
        if ($data['type'] === 'person') {
            $person_service = new PersonService();
            $data['name'] = $data['first_name']." ".$data["last_name"];
            $person_service->create($data);
        }

        if ($data['type'] === 'dealer') {
            if (!empty($data['email_dealer'])) {
                $data['email'] = $data['email_dealer'];
            }
            if (!empty($data['name_dealer'])) {
                $data['name'] = $data['name_dealer'];
            }
            $dealer_service = new DealerService();
            $dealer_service->create($data);
        }

        if ($data['type'] === 'broker') {
            $broker_service = new BrokerService();
            $broker_service->create($data);
        }
    }

    private function startPlan(Int $company_id, Int $type)
    {
        $plan_service = new AdminPlanService();
        $type = PlanType::find($type);
        $plan_service->startPlan($company_id, $type);
    }
}
