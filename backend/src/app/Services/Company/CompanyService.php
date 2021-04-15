<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Models\Plan;
use App\Repositories\CompanyRepository;
use App\Services\Dealer\GalleryDealerService;
use Carbon\Carbon;
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
            $entity->profile_url = !empty($entity->profile_path) ? Storage::url($entity->profile_path) : null;
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

    public function detailLastPlan(Company $company) :? Plan
    {
        $plan = $company->plans->last();
        if (empty($plan)) {
            return null;
        }
        $plan->started_date = Carbon::make($plan->started_at)->format('Y-m-d');
        $plan->finished_date = Carbon::make($plan->finished_at)->format('Y-m-d');
        return $plan->detail();
    }

    public function detailByPlans(Company $company)
    {
        $plans = $company->plans;
        return $plans->map(function (Plan $plan) {
            return $plan->detail();
        });
    }

    public function detailByPlanType(Company $company)
    {
        return $company->planType;
    }

    public function emailToSend(Company $company) : string
    {
        if ($company->type === 'dealer') {
            return $company->dealer->getEmailToSend();
        }
        return $company->person->getEmailToSend();
    }
}
