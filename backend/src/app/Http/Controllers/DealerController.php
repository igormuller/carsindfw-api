<?php

namespace App\Http\Controllers;

use App\Http\Requests\DealerRequest;
use App\Services\Dealer\DealerService;

class DealerController extends Controller
{
    private $service;

    public function __construct() {$this->service = new DealerService();}

    public function index()
    {
        return $this->service->allDealers();
    }

    public function store(DealerRequest $request)
    {
        //
    }

    public function show($id)
    {
        $dealer = $this->service->find($id);
        return $this->service->detailEdit($dealer);
    }

    public function update(DealerRequest $request, $id)
    {
        $data = $request->all();
        $dealer = $this->service->find($id);
        $dealer = $this->service->update($dealer, $data);
        return $this->service->detailEdit($dealer);
    }

    public function destroy($id)
    {
        //
    }

    public function citiesDealers()
    {
        return $this->service->allCities();
    }

    public function dealersByCity($city_id)
    {
        return $this->service->dealersByCity($city_id);
    }

    public function dealerDetail($dealer_id)
    {
        $dealer = $this->service->find($dealer_id);
        return $this->service->detail($dealer);
    }
}
