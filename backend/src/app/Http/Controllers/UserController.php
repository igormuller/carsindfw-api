<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\User\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    private $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    public function checkVerifyToken(Request $request)
    {
        $user = User::findOrFail($request->id);
        if (!empty($user->email_verified_at)) {
            return response(['message' => 'E-mail already verified!'], 422);
        }

        if (Hash::check($user->email, $request->token)) {
            $user->email_verified_at = Carbon::now();
            $user->save();
            return response(['message' => 'E-mail verified']);
        }

        return response(['message' => 'Token not checked'], 403);
    }

    public function newVerifyToken(string $email)
    {
        $user = User::where('email', $email)->first();

        if (empty($user)) {
            return response(['message' => 'E-mail not exist!'], 404);
        }

        if (!empty($user->email_verified_at)) {
            return response(['message' => 'E-mail already verified!'], 422);
        }

        $user->email_verify_token = Hash::make($user->email);
        $user->save();
        $this->service->sendEmailVerify($user);
        return response(['message' => 'New token generate']);
    }

    public function index()
    {
        return User::thisCompany()->get();
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'company_id' => 'required|integer|exists:companies,id',
                'name'       => 'required|string',
                'email'      => 'required|email|unique:users',
                'password'   => 'required|min:6',
            ]
        );

        $data = $request->all();
        return $this->service->create($data);
    }

    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'name'     => 'required|string',
                'email'    => ['required', 'email', Rule::unique('users')->ignore($user->id)],
                'password' => 'min:6',
            ]
        );
        $data = $request->all();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return $user;
    }

    public function show($id)
    {
        $user = User::thisCompany()->where('id', $id)->first();

        if (empty($user)) {
            return \response("Don't find user!", 404);
        }

        return $user;
    }

    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return \response("Can't remove your user!", 400);
        }
        $delete = $user->delete();
        if ($delete) {
            return \response('User removed with success!',200);
        }
        return \response("User don't removed!",400);
    }

    public function info()
    {
        $user = Auth::user();
        $data_user = $user->toArray();
        $data_user['company'] = $user->getInfoCompany();
        return $data_user;
    }
}
