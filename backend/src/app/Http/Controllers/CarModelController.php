<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function getModelsByMake(Request $request)
    {
        return CarModel::where('car_make_id', $request->make)->orderBy('name')->get();
    }
}
