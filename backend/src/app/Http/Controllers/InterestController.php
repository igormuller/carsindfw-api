<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterInterestRequest;
use App\Services\Interest\InterestService;

class InterestController extends Controller
{
    public function register(RegisterInterestRequest $request)
    {
        $service = new InterestService();
        $register = $service->hasRegister($request->all());
        if ($register) {
            return response(['message'=>"You've already made an offer for this ad", "errors" => []], 422);
        }
        return $service->register($request->all());
    }
}
