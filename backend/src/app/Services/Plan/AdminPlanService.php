<?php

namespace App\Services\Plan;

use App\Enums\TypeEnum;
use App\Models\Company;
use App\Models\Plan;
use App\Models\PlanType;
use App\Repositories\PlanRepository;
use App\Services\Company\CompanyService;
use Carbon\Carbon;

class AdminPlanService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new PlanRepository();
    }

    public function create(PlanType $type, int $company_id, array $options = []) : Plan
    {
        $started_at = empty($options['started']) ? Carbon::now() : Carbon::parse($options['started']);
        $finished_days = $options['finished_days']?? $type->days;

        $data = [
            'company_id'   => $company_id,
            'plan_type_id' => $type->id,
            'started_at'   => $started_at,
            'finished_at'  => $started_at->copy()->addDays($finished_days),
        ];

        return $this->repository->create($data);
    }

    public function newPlan(PlanType $type, Company $company) : Plan
    {
        $today = Carbon::now();
        $companyService = new CompanyService();
        $lastPlan = $companyService->detailLastPlan($company);

        $options = [];
        if (!empty($lastPlan) && $lastPlan->finished_at > $today) {
            $options['started'] = $lastPlan->finished_at;
        }

        $company->status       = TypeEnum::COMPANY_STATUS_ACTIVED;
        $company->plan_type_id = $type->id;
        $company->save();
        return $this->create($type, $company->id, $options);
    }
}
