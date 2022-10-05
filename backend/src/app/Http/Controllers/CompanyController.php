<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCompanyWithUser;
use App\Models\Company;
use App\Services\Company\StartCompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\CardException;

class CompanyController extends Controller
{
    public function index()
    {
        return Company::all()->map(function ($item) {
            return $item->getAllInfo();
        });
    }

    public function start(NewCompanyWithUser $request, StartCompanyService $service)
    {
        try {
            $service->createWithUser($request->all());
            return redirect('dealer-plan')->with('message', 'Register with success!!');
        } catch (CardException $e) {
            return redirect('dealer-plan')->withErrors([$e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, Company $company)
    {
        //
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        if ($company->id !== Auth::user()->company_id) {
            return \response("Don't find company!", 404);
        }
        return $company->getAllInfo();
    }

    public function destroy(Company $company)
    {
        //
    }
}
