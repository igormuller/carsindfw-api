<?php

namespace App\Http\Controllers;

use App\Models\PlanType;
use Illuminate\Http\Request;

class PlanTypeController extends Controller
{
    public function listPlanTypes()
    {
        return PlanType::all();
    }
}
