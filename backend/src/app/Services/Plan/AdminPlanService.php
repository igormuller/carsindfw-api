<?php

namespace App\Services\Plan;

use App\Models\Plan;
use App\Models\PlanType;
use App\Repositories\PlanRepository;
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
        $started_at = Carbon::now();
        $finished_at = Carbon::now()->addDays($type->days);
        $data = [
            'company_id'   => $company_id,
            'plan_type_id' => $type->id,
            'started_at'   => !empty($options['started']) ? $started_at->addDays($options['started']) : $started_at,
            'finished_at'  => !empty($options['finished']) ? $finished_at->addDays($options['finished']) : $finished_at,
        ];

        return $this->repository->create($data);
    }
}
