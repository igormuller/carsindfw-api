<?php

namespace App\Services\Interest;

use App\Mail\RegisterInterestEmail;
use App\Mail\RegisterInterestEmailCopy;
use App\Repositories\InterestRepository;
use Illuminate\Support\Facades\Mail;

class InterestService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new InterestRepository();
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
        $emailSend = env('MAIL_SEND');
        Mail::to($emailSend)->send(new RegisterInterestEmail($data));
        return ['email_send'];
    }
}
