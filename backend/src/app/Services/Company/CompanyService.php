<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Repositories\AddressRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\UserRepository;
use App\Services\Broker\BrokerService;
use App\Services\Dealer\DealerService;
use App\Services\Dealer\GalleryDealerService;
use App\Services\Person\PersonService;
use App\Services\Plan\AdminPlanService;
use Illuminate\Support\Facades\Storage;

class CompanyService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new CompanyRepository();
    }

    public function detail(Company $company)
    {
        $entity = $this->repository->getModelType($company);
        $entity->type = $company->type;
        if ($company->type === 'dealer') {
            $galleryDealer = new GalleryDealerService();
            $entity->profile_url = Storage::url($entity->profile_path);
            $entity->gallery = $galleryDealer->getGalleryData($entity);
        }
        return $entity->load(
            [
                'address',
                'address.city',
                'address.state',
            ]
        )->toArray();
    }
}
