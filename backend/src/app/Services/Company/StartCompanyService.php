<?php

namespace App\Services\Company;

use App\Enums\TypeEnum;
use App\Models\Address;
use App\Models\Company;
use App\Models\PlanType;
use App\Repositories\AddressRepository;
use App\Repositories\CompanyRepository;
use App\Services\Broker\BrokerService;
use App\Services\Dealer\DealerService;
use App\Services\Payment\PaymentService;
use App\Services\Person\PersonService;
use App\Services\Plan\AdminPlanService;
use App\Services\User\UserService;
use App\Services\Zipcode\ZipcodeService;
use Stripe\Exception\CardException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class StartCompanyService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new CompanyRepository();
    }

    public function createWithUser(Array $data): Company
    {
        $type = PlanType::findOrFail($data['plan_type_id']);
        $data['type'] = $type->company_type;
        if ($type->company_type === 'person') {
            $company = $this->createPerson($data);
        }

        if ($type->company_type === 'dealer') {
            $company = $this->createDealer($data);
        }

        $data['company_id'] = $company->id;
        $userData = $data;
        $userData['name'] = $data['user_name'];
        $userData['email'] = $data['user_email'];
        $userService = new UserService();
        $userService->create($userData);

        return $company;
    }

    public function createPerson(array $data)
    {
        $company = $this->repository->create($data);
        $data['company_id'] = $company->id;

        $this->createAddress($data);

        $personService = new PersonService();
        $data['name'] = $data['user_name'];
        $personService->create($data);

        $this->startPlan($company->id, $data['plan_type_id']);

        return $company;
    }

    public function createDealer(array $data)
    {
        $paymentService = new PaymentService();
        $paymentMethod = $paymentService->createPaymentMethod($data);

        $company = $this->repository->create($data);
        $data['company_id'] = $company->id;

        $address = $this->createAddress($data);
        $addressData = $address->toArray();
        $addressData['city_name'] = $address->city->name;
        $addressData['state_initials'] = $address->state->initials;

        $dataPayment = array_merge($data, ['address' => $addressData]);
        try {
            $customerPayment = $paymentService->createCustomer($dataPayment, $paymentMethod);
        } catch (CardException $e) {
            $address->delete();
            $company->delete();
            throw new CardException($e->getMessage(), $e->getCode());
        }

        if (empty($customerPayment)) {
            throw new HttpException('402', 'Internal error, contact us to resolve this problem!');
        }

        $dealerService = new DealerService();
        $dealerService->create($data);

        $type = PlanType::find($data['plan_type_id']);
        $this->startPlan($company->id, $data['plan_type_id']);
        $dataSubscription = [
            'customer_id'    => $customerPayment->id,
            'promotion_code' => $data['promotion_code'] ?? null,
        ];
        $paymentService->createSubscription($dataSubscription, $type);

        $company->stripe_id = $customerPayment->id;
        $company->save();

        return $company;
    }

    private function createAddress(array $data) : Address
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

    private function startPlan(int $company_id, int $type, array $option = [])
    {
        $plan_service = new AdminPlanService();
        $type = PlanType::find($type);
        $plan_service->create($type, $company_id, $option);
    }
}
