<?php

namespace App\Services\User;

use App\Mail\EmailVerifyToken;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\General\StorageService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function findByCompany(int $id) : User
    {
        return $this->repository->findByCompanyLogged($id);
    }

    public function userInfo(User $user) : User
    {
        $user = $this->detail($user);
        $user->company_type = $user->getInfoCompany();
        return $user;
    }

    public function create(array $data) : User
    {
        $user = $this->repository->create($data);
        $this->sendEmailVerify($user);
        return $user;
    }

    public function update(array $data, User $user): User
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $storage = new StorageService();
        if (empty($data['profile_path']) && !empty($user->profile_path)) {
            $storage->delete($user->profile_path);
        }

        if (!empty($data['profile_path']) && ($data['profile_path'] !== $user->profile_path)) {
            if (!empty($user->profile_path)) {
                $storage->delete($user->profile_path);
            }
            $document = $storage->convertBase64ToFileUploaded($data['profile_path']);
            $path = "/user/".$user->id;
            $profile_path = $storage->upload($document, $path);
            $data['profile_path'] = $profile_path;
        }

        $user->update($data);
        return $this->detail($user);
    }

    public function detail(User $user) : User
    {
        $storage = new StorageService();
        $user->profile_url = !empty($user->profile_path) ? $storage->getUrl($user->profile_path) : null;

        return $user;
    }

    public function sendEmailVerify(User $user)
    {
        $data['link'] = env('FRONT_URL') . '/validate-token?user_check=' . $user->id . '&token=' . $user->email_verify_token;
        Mail::to($user->email)->send(new EmailVerifyToken($data));
    }
}
