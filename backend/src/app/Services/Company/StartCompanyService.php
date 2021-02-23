<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Models\PlanType;
use App\Repositories\AddressRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\UserRepository;
use App\Services\Broker\BrokerService;
use App\Services\Dealer\DealerService;
use App\Services\Payment\PaymentService;
use App\Services\Person\PersonService;
use App\Services\Plan\AdminPlanService;
use App\Services\User\UserService;
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

        $data['company_id'] = $company->id;
        $userData = $data;
        $userData['name'] = $data['user_name'];
        $userData['email'] = $data['user_email'];
        $userService = new UserService();
        $userService->create($userData);

        return $company;
    }

    public function create(array $data) : Company
    {
        $company = $this->repository->create($data);
        $data['company_id'] = $company->id;

        $address = $this->createAddress($data);

        $this->createType($data);
        $this->startPlan($company->id, 1);

        $paymentService = new PaymentService();
        $addressData = $address->toArray();
        $addressData['city_name'] = $address->city->name;
        $addressData['state_initials'] = $address->state->initials;
        $dataPayment = array_merge($data, ['address' => $addressData]);
        $customerPaymentId = $paymentService->createPaymentMethodAndCustomer($dataPayment);
        $type = PlanType::find($data['plan_type_id']);
        $paymentService->createSubscription($customerPaymentId, $type->stripe_id, $type->trial_period_days);
        $company->stripe_id = $customerPaymentId;
        $company->save();

        return $company;
    }

    private function createAddress(array $data)
    {
        $zipcodeService = new ZipcodeService();
        $zipcode = $zipcodeService->searchZipcode($data['zipcode']);
        if (!empty($zipcode)) {
            $data['city_id'] = $zipcode->city_id;
            $data['state_id'] = $zipcode->city->state_id;
        }
        $repository = new AddressRepository();
        return $repository->create($data);
    }

    private function createType(array $data)
    {
        if ($data['type'] === 'person') {
            $personService = new PersonService();
            $data['name'] = $data['user_name'];
            $personService->create($data);
        }

        if ($data['type'] === 'dealer') {
            $dealerService = new DealerService();
            $dealerService->create($data);
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
