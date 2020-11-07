<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PersonController extends Controller
{
    private $model;

    public function __construct() {$this->model = new Person();}

    public function index()
    {
        $this->model->all();
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'      => 'required|string',
                'email'     => 'required|unique:users',
                'password'  => 'required|min:6',
                'document'  => 'required|string|min:11|max:16',
            ]
        );

        $data = $this->model->create($request->all());

        $newUser = $request->all();
        $newUser['password'] = Hash::make($request->password);
        $newUser['person_id'] = $data->id;
        User::create($newUser);
        return response('Person included', 200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
