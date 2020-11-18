<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function teste(Request $request)
    {
        dd("aqui");
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
        $data['password'] = Hash::make($request->password);
        return User::create($data);
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