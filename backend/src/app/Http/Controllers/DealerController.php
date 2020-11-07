<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Services\Dealer\DealerService;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    private $service;

    public function __construct() {$this->service = new DealerService();}

    public function index()
    {
        $this->service->allDealers();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
        $dealer = Dealer::findOrFail($dealer_id);
        return $this->service->detail($dealer);
    }
}
