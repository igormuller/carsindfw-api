<?php

namespace App\Services\Dealer;

use App\Models\Dealer;
use App\Repositories\DealerRepository;
use Illuminate\Support\Facades\DB;

class DealerService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new DealerRepository();
    }

    public function create(array $data) : Dealer
    {
        return $this->repository->create($data);
    }

    public function find(int $id) : Dealer
    {
        return $this->repository->findOrFail($id);
    }

    public function detailEdit(Dealer $dealer) : Dealer
    {
        return $dealer->load('address');
    }

    public function detail(Dealer $dealer) : Dealer
    {
        return $dealer->load(
            [
                'address',
                'address.city',
                'advertisements'
            ]
        );
    }

    public function allDealers()
    {
        $dealers = $this->repository->all();
        return $dealers->load('address', 'address.city', 'address.state');
    }

    public function allCities() : array
    {
        $dealers = $this->repository->all();
        return $dealers->load('company.address.city')
                       ->pluck('company.address.city.name', 'company.address.city.id')
                       ->toArray();
    }

    public function dealersByCity(int $city_id) : array
    {
        return DB::table('dealers')
                 ->select('dealers.*', 'addresses.city_id', 'addresses.street', 'addresses.number')
                 ->join('addresses', 'addresses.company_id', '=', 'dealers.company_id')
                 ->where('addresses.city_id', $city_id)
                 ->get()
                 ->toArray();
    }
}
