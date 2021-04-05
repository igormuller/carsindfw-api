<?php

namespace App\Services\Plan;

use App\Mail\PlanEndDealer;
use App\Mail\PlanEndPerson;
use App\Models\Company;
use App\Services\Company\CompanyService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CheckPlanService
{
    public function endInDays(int $days)
    {
        $companies = Company::where('status', 'actived')->get();

        $endCompanies = collect();
        foreach ($companies as $company) {
            $plan = $company->plans->last();
            if (empty($plan)) {
                continue;
            }

            $dateCheck        = Carbon::today()->addDays($days)->format('Y-m-d');
            $company->endPlan = Carbon::make($plan->finished_at)->format('Y-m-d');

            if ($company->endPlan !== $dateCheck) {
                continue;
            }
            $endCompanies = $endCompanies->merge([$company]);
        }
        return $endCompanies;
    }

    public function sendEmailPlansEndInDays(int $days)
    {
        $companies = $this->endInDays($days);
        $companyService = new CompanyService();

        foreach ($companies as $company) {
            $company->emailToSend = $companyService->emailToSend($company);
            $company->link = env('FRONT_URL') . '/admin/plan';

            if ($company->type === 'dealer') {
                Mail::to($company->emailToSend)->send(new PlanEndDealer($company->toArray()));
            }

            if ($company->type === 'person') {
                Mail::to($company->emailToSend)->send(new PlanEndPerson($company->toArray()));
            }
        }
    }
}
