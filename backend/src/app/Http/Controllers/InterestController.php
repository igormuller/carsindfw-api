<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterInterestRequest;
use App\Services\Interest\InterestService;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new InterestService();
    }
    public function index()
    {
        return $this->service->all();
    }

    public function update(Request $request)
    {
        $entity = $this->service->find($request->id);
        return $this->service->update($entity, $request->all());
    }

    public function register(RegisterInterestRequest $request)
    {
        $this->service = new InterestService();
        $register = $this->service->hasRegister($request->all());
        if ($register) {
            return response(['message'=>"You've already made an offer for this ad", "errors" => []], 422);
        }
        return $this->service->register($request->all());
    }
}
