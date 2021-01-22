<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function create(array $data) : User
    {
        return $this->repository->create($data);
//        $userVerification = $this->repository->createVerification($user);
    }
}
