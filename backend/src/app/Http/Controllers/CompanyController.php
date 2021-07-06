<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCompanyWithUser;
use App\Models\Company;
use App\Services\Company\StartCompanyService;
use GuzzleHttp\Client;
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
            $company = $service->createWithUser($request->all());
            return response('Company created success!' . $company->id);
        } catch (CardException $e) {
            return response(['message' => $e->getMessage()], 402);
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

    public function getDataOtherSites()
    {
        // Post
        $url = "https://p18f03ix1o-dsn.algolia.net/1/indexes/*/queries?x-algolia-application-id=P18F03IX1O&x-algolia-api-key=8b446e0ab4fc10f6cec8619a8e0c2eeb";
        $data = '{"requests": [{"indexName":"prod_products","hitsPerPage":100}]}';

        $client = new Client();
        $response = $client->post($url, ['body' => $data]);
        $response = json_decode($response->getBody());
        $hits = $response->results[0]->hits;
        foreach ($hits as $hit) {
            dd($hit);
        }

        // Get
        $url = "https://www.tricolor.com/Inventory/VehiclesDecoded";
        $client = new Client();
        $response = $client->get($url);
        $response = json_decode($response->getBody());
    }
}
