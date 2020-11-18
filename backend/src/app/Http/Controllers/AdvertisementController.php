<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvertisement;
use App\Models\Advertisement;
use App\Repositories\AdvertisementRepository;
use App\Services\Advertisement\AdvertisementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdvertisementController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new AdvertisementService();
    }
    public function index(AdvertisementRepository $repository)
    {
        return $repository->getAllInfo();
    }

    public function getLastCars()
    {
        return $this->service->getLastCars();
    }

    public function show(Advertisement $advertisement)
    {
        return $this->service->dataToShow($advertisement);
    }

    public function store(StoreAdvertisement $request)
    {
        return $this->service->create($request->all());
    }

    public function update(StoreAdvertisement $request, Advertisement $advertisement)
    {
        return $this->service->update($advertisement, $request->all());
    }

    public function destroy($id)
    {
        $response = $this->service->delete($id);

        if ($response) {
            return response("Advertisement removed with Success!!!", 200);
        }
        return response("Error when remove Advertisement!!!", 422);
    }

    public function search(Request $request)
    {
        $data = $request->all();
        $dataSearch = json_decode($data['dataSearch'],true);
        $advertisements = $this->service->search($dataSearch);

        $advertisements = $advertisements->paginate($data["paginate"]);

        $advertisementsData = $this->service->collectionToShow(collect($advertisements->items()));
        $advertisements->data = $advertisementsData->toArray();
        return $advertisements;
    }

    public function vinCheck($vin_number)
    {
        $url = 'https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVinExtended/'.$vin_number.'?format=json';
        $response = Http::get($url);
        return $response->json();
    }
}
