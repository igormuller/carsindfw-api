<?php

namespace App\Services\Advertisement;

use App\Models\Advertisement;
use App\Repositories\AdvertisementRepository;
use App\Services\Company\CompanyService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AdvertisementService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new AdvertisementRepository();
    }

    public function find(int $id) : Advertisement
    {
        return $this->repository->findOrFail($id);
    }

    public function create(array $data) : Advertisement
    {
        $data['company_id'] = Auth::user()->company_id;
        $data = $this->prepareData($data);
        return $this->repository->create($data);
    }

    public function update(Advertisement $advertisement, array $data) : Advertisement
    {
        $data = $this->prepareData($data);
        $advertisement = $this->repository->update($advertisement, $data);
        return $this->dataToShow($advertisement);
    }

    private function prepareData(array $data) : array
    {
        if (!empty($data['features'])) {
            $data['features'] = implode(',', $data['features']);
        } else {
            $data['features'] = null;
        }

        $data['value']      = str_replace(',', '', $data['value']);
        $data['vin_number'] = strtoupper(str_replace(' ', '', $data['vin_number']));

        return $data;
    }

    public function getLastCars() : array
    {
        $advertisements = $this->repository->getLastCreatedAt(6);
        $data = [];
        foreach ($advertisements as $item) {
            $aux                 = [];
            $aux['id']           = $item->id;
            $aux['photo']        = $this->repository->getURLPhoto($item);
            $aux['make_name']    = $item->carMake->name;
            $aux['model_name']   = $item->carModel->name;
            $aux['trim']         = $item->trim;
            $aux['company_name'] = $item->company->getName();
            $data[]              = $aux;
        }
        return $data;
    }

    public function collectionToShow($data)
    {
        $advertisementData = [];
        foreach ($data as $item) {
            $advertisementData[] = $this->dataToShow($item);
        }
        return $advertisementData;
    }

    public function dataToShow(Advertisement $entity) : Advertisement
    {
        $data = $this->repository->getEntityData($entity);

        $companyService = new CompanyService();
        $data->company_data = $companyService->detail($entity->company);
        $data->gallery_data = $this->repository->getGalleryData($data);

        return $data;
    }

    public function delete(int $id)
    {
        $entity = $this->repository->findOrFail($id);
        return $this->repository->delete($entity);
    }

    public function search(array $data)
    {
        $advertisements = new Advertisement();
        if (!empty($data['year_start']) && !empty($data['year_end'])) {
            $advertisements = $advertisements->whereBetween('year', [$data['year_start'], $data['year_end']]);
        }
        if (!empty($data['type'])) {
            $advertisements = $advertisements->where('type', $data['type']);
        }
        if (!empty($data['make'])) {
            $advertisements = $advertisements->where('car_make_id', $data['make']);
        }
        if (!empty($data['model'])) {
            $advertisements = $advertisements->where('car_model_id', $data['model']);
        }
        if (!empty($data['category'])) {
            $advertisements = $advertisements->where('body_type', $data['category']);
        }
        if (!empty($data['company_id'])) {
            $advertisements = $advertisements->where('company_id', $data['company_id']);
        }
        if (!empty($data['value'])) {
            $data['value'] = str_replace(',','', $data['value']);
            $advertisements = $advertisements->where('value', '<=', $data['value']);
        }
        if (!empty($data['fuel_type'])) {
            $advertisements = $advertisements->where('fuel_type', $data['fuel_type']);
        }
        if (!empty($data['fuel_type'])) {
            $advertisements = $advertisements->where('fuel_type', $data['fuel_type']);
        }
        if (!empty($data['transmission_type'])) {
            $advertisements = $advertisements->where('transmission_type', $data['transmission_type']);
        }
        if (!empty($data['drive_train'])) {
            $advertisements = $advertisements->where('drive_type', $data['drive_train']);
        }
        if (!empty($data['miles'])) {
            $advertisements = $advertisements->where('miles', '<', $data['miles']);
        }

        return $advertisements;
    }
}
