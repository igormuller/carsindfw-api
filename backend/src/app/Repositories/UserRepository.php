<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new User();
    }

    public function findOrFail(int $id)
    {
        return $this->entity->findOrFail($id);
    }

    public function findByCompanyLogged(int $id)
    {
        $user = $this->entity->thisCompany()->where('id', $id)->first();
        if (empty($user)) {
            throw new HttpException(404, "User not find!");
        }
        return $user;
    }

    public function create(array $data) : User
    {
        $data['password'] = Hash::make($data['password']);
        $data['email_verify_token'] = Hash::make($data['email']);
        return $this->entity->create($data);
    }

    public function createVerification(User $user)
    {
        $userVerification = new UserVerification();
        $userVerification->user_id = $user->id;
        $userVerification->token = Hash::make(time());
        $userVerification->expires_in = Carbon::now()->addDays(5);
        $userVerification->save();
    }
}
