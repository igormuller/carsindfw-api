<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new User();
    }

    public function create(Array $data) : User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->entity->create($data);
    }
}
