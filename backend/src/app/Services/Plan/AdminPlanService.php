<?php

namespace App\Services\Plan;

use App\Enums\TypeEnum;
use App\Models\Plan;
use App\Models\PlanType;
use App\Repositories\PlanRepository;
use Carbon\Carbon;

class AdminPlanService
{
    private $repository;
    private $type;

    public function __construct()
    {
        $this->repository = new PlanRepository();
    }

    public function startPlan(Int $company_id, PlanType $type, Int $started = null, Int $finished = null) : Plan
    {
        $this->type = $type;
        $started_at  = $this->getStartDate($started);
        $finished_at = $this->getFinishDate($finished);
        $data = [
            'company_id'   => $company_id,
            'started_at'   => $started_at,
            'finished_at'  => $finished_at,
            'status'       => TypeEnum::PLAN_OPENED,
            'plan_type_id' => $type->id,
        ];

        return $this->repository->create($data);
    }

    private function getStartDate(Int $started = null) : Carbon
    {
        $started_at = Carbon::now();
        if (!empty($started)) {
            $started_at = $started_at->addDays($started);
        }
        return $started_at;
    }

    private function getFinishDate(Int $finished = null) : Carbon
    {
        $finished_at = Carbon::now()->addDays($this->type->days);
        if (!empty($finished)) {
            $finished_at = $finished_at->addDays($finished);
        }
        return $finished_at;
    }
}
