<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvertisement;
use App\Models\CarModelDescription;
use Illuminate\Http\Request;

class CarModelDescriptionController extends Controller
{
    public function getCategoriesByModel(Request $request)
    {
        return CarModelDescription::join('body_types', 'body_types.id', 'car_model_descriptions.body_type_id')
                                         ->where('car_model_id', $request->model)
                                         ->select('body_types.id','body_types.name')
                                         ->get()
                                         ->unique('body_types.name');
    }

    public function getYearsByModel(Request $request)
    {
        return CarModelDescription::where('car_model_id', $request->model)->get()->unique('year')->pluck('year');
    }

    public function getData(Request $request)
    {
        return CarModelDescription::findOrFail($request->id);
    }

    public function searchTrim(Request $request)
    {
        $request->validate(
            ['model' => 'required|integer',
             'year'  => 'required|integer',]
        );
        $data['car_model_id'] = $request->model;
        $data['year'] = $request->year;

        return CarModelDescription::where($data)->get();
    }
}
