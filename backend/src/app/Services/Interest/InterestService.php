<?php

namespace App\Services\Interest;

use App\Mail\RegisterInterestEmail;
use App\Mail\RegisterInterestEmailCopy;
use App\Models\Interest;
use App\Repositories\InterestRepository;
use Illuminate\Support\Facades\Mail;

class InterestService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new InterestRepository();
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find(int $id) : Interest
    {
        return $this->repository->findOrFail($id);
    }

    public function update(Interest $interest, array $data) : Interest
    {
        return $this->repository->update($interest, $data);
    }

    public function hasRegister(array $data) : bool
    {
        $advertisement_id = $data['advertisement_id'] ?? null;
        $email = $data['email'] ?? null;
        $phone = $data['phone'] ?? null;
        $interest = $this->repository->hasRegister($advertisement_id, $email, $phone);
        return $interest->isNotEmpty();
    }

    public function register(array $data) : array
    {
        $interest = $this->repository->create($data);

        if ((!empty($data['copy']) && $data['copy']) && !empty($data['email'])) {
            Mail::to($data['email'])->send(new RegisterInterestEmailCopy($data));
        }

        $make_name   = $interest->advertisement->carMake->getName();
        $model_name  = $interest->advertisement->carModel->getName();

        $data['car'] = $make_name . " / " . $model_name;
        $data['link'] = env('FRONT_URL').'/car-detail/'.$interest->advertisement->id;

        $company = $interest->advertisement->company;
        $companyType = $company->thisType();

        Mail::to($companyType->email)->send(new RegisterInterestEmail($data));
        return ['email_send'];
    }
}
