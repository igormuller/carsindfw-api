<?php

namespace App\Http\Controllers;

use App\Models\CarMake;
use Illuminate\Http\Request;

class CarMakeController extends Controller
{
    public function index()
    {
        return CarMake::all();
    }

    public function searchMakes(Request $request)
    {
        return CarMake::orWhere('name', 'LIKE', '%' . $request->make . '%')->orWhere('id', $request->make)->get();
    }
}

