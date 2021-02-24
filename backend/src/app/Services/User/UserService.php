<?php

namespace App\Services\User;

use App\Mail\EmailVerifyToken;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;

class UserService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function create(array $data) : User
    {
        $user = $this->repository->create($data);
        $this->sendEmailVerify($user);
        return $user;
    }

    public function sendEmailVerify(User $user)
    {
        $data['link'] = env('FRONT_URL') . '/validate-token?user_check=' . $user->id . '&token=' . $user->email_verify_token;
        Mail::to($user->email)->send(new EmailVerifyToken($data));
    }
}
