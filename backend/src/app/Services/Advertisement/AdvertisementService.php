<?php

namespace App\Services\Advertisement;

use App\Models\Advertisement;
use App\Repositories\AdvertisementRepository;
use App\Services\Company\CompanyService;
use App\Services\Dealer\DealerService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AdvertisementService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new AdvertisementRepository();
    }

    public function create(array $data) : Advertisement
    {
        $data['company_id'] = Auth::user()->company_id;
        if (!empty($data['features'])) {
            $data['features'] = implode(',', $data['features']);
        }
        return $this->repository->create($data);
    }

    public function getLastCars() : Collection
    {
        $data = $this->repository->getLastCreatedAt(6);

        return $this->collectionToShow($data);
    }

    public function collectionToShow(Collection $data) : Collection
    {
        $data = $data->map(function ($item) {
            $item               = $this->repository->getEntityData($item);
            $item->photo        = $this->repository->getURLRandomPhoto($item);
            $item->company_data = $this->repository->getCompanyData($item);
            return $item;
        });
        return $data;
    }

    public function dataToShow(Advertisement $entity) : Advertisement
    {
        $data          = $this->repository->getEntityData($entity);

        $companyService = new CompanyService();
        $data->company_data = $companyService->detail($entity->company);
        $data->gallery = $this->repository->getGalleryData($data);

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

        return $advertisements;
    }
}
