<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarModelDescription;
use App\Models\Advertisement;
use App\Models\Dealer;
use App\Models\FeaturedAdvertisement;
use App\Models\Address;
use App\Models\City;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    public function carList(Request $request)
    {
        return view('pages.car-list', [
            /*
            'home' => $home,
            'categories' => $categories,
            'featured' => $featured,
            'products' => $products,
            'total_content' => $total_content,
            'last_contents' => $last_contents,
            */
        ]);
    }

    public function findCar(Request $request)
    {
        $listFeaturedAds = Advertisement::select('advertisements.*')->join('featured_advertisements as fa', 'fa.advertisement_id', 'advertisements.id')->where('expires_in', '>=', date('Y-m-d H:i:s'))->get();

        return view('pages.car-list', [
            'listAds' => $listFeaturedAds,
            /*
            'home' => $home,
            'categories' => $categories,
            'featured' => $featured,
            'products' => $products,
            'total_content' => $total_content,
            'last_contents' => $last_contents,
            */
        ]);
    }

    public function findDealer($city = null)
    {
        $queryDealers = Dealer::select('dealers.*')->with('address')->with('company')->join('companies','companies.id','dealers.company_id')->join('addresses','companies.id','addresses.company_id');
        if ($city && $city != '') {
            $queryDealers->where('addresses.city_id', $city);
        }
        //$listFeaturedAds = Advertisement::select('advertisements.*')->join('featured_advertisements as fa', 'fa.advertisement_id', 'advertisements.id')->where('expires_in', '>=', date('Y-m-d H:i:s'))->get();
        $listDealers = $queryDealers->get();
        $listCities = City::select('cities.*')->distinct()->join('addresses','cities.id','addresses.city_id')->get();

        return view('pages.dealer-list', [
            'listDealers' => $listDealers,
            'listCities' => $listCities,
            'citySelected' => $city,
        ]);
    }

    public function carDetail(Advertisement $car)
    {
        $relateds = Advertisement::where('id', '<>', $car->id)->where('car_model_id', $car->car_model_id)->limit(4)->get();
    
        return view('pages.car-detail', ['car'=>$car, 'relateds'=>$relateds]);
    }


    public function dealerDetail(Dealer $dealer)
    {
        return view('pages.dealer-detail', [
            'dealer' => $dealer,
        ]);
    }

    public function searchMakes(Request $request)
    {
        return Advertisement::select('car_makes.*')->distinct()->join('car_makes', 'advertisements.car_make_id', 'car_makes.id' )
        ->orWhere('car_makes.name', 'LIKE', '%' . $request->q . '%')
        ->orWhere('car_makes.id', $request->q)
        ->orderBy('car_makes.name')
        ->get()->toArray();
    }

    public function searchModels(Request $request)
    {
        $carModel = Advertisement::select('car_models.*')->distinct()
        ->join('car_models', 'advertisements.car_model_id', 'car_models.id' )
        ->where(function ($query) use ($request) {
            $query->orWhere('car_models.name', 'LIKE', '%' . $request->q . '%')->orWhere('car_models.id', $request->q);
        });

        if ($request->make) {
            $carModel->where('car_models.car_make_id', $request->make);
        }

        $models = $carModel->get()->toArray();
        return response()->json($models);

    }

    public function searchFuels(Request $request)
    {
        $query = $this->makeSearchQuery("fuel_type", $request);
        $fuels = $query->get()->toArray();
        return response()->json($fuels);
    }

    public function searchYears(Request $request)
    {
        $query = Advertisement::select(\DB::raw("MIN(year) AS minYear, MAX(year) AS maxYear"))
        ->groupBy('year');

        if (isset($request->make)) {
            $query->where('advertisements.car_make_id', $request->make);
        }
        if (isset($request->model)) {
            $query->where('advertisements.car_model_id', $request->model);
        }

        $year = $query->first();
        $listYears = [];
        for ($i = $year->maxYear; $i >= $year->minYear; $i--) {
            $listYears[] = (int)$i;
        }
        
        return response()->json($listYears);
    }

    public function searchTransmissions(Request $request)
    {
        $query = $this->makeSearchQuery("transmission_type", $request);
        $types = $query->get()->toArray();
        return response()->json($types);
    }

    public function searchDrives(Request $request)
    {
        $query = $this->makeSearchQuery("drive_type", $request);
        $types = $query->get()->toArray();
        return response()->json($types);
    }

    public function searchBodies(Request $request)
    {
        $query = $this->makeSearchQuery("body_type", $request);
        $types = $query->get()->toArray();
        return response()->json($types);
    }

    private function makeSearchQuery($fSelect, $request){
        $query = Advertisement::select($fSelect)
        ->groupBy($fSelect);

        if (isset($request->make)) {
            $query->where('advertisements.car_make_id', $request->make);
        }
        if (isset($request->model)) {
            $query->where('advertisements.car_model_id', $request->model);
        }

        return $query;
    }

    public function searchCars(Request $request)
    {
        $queryAds = Advertisement::select('advertisements.*');

        if (isset($request->filter_make)) {
            $queryAds->where('advertisements.car_make_id', $request->filter_make);
        }
        if (isset($request->filter_model)) {
            $queryAds->where('advertisements.car_model_id', $request->filter_model);
        }
        if (isset($request->filter_fuel)) {
            $queryAds->where('advertisements.fuel_type', $request->filter_fuel);
        }
        if (isset($request->filter_body)) {
            $queryAds->where('advertisements.body_type', $request->filter_body);
        }
        if (isset($request->filter_transmission)) {
            $queryAds->where('advertisements.transmission_type', $request->filter_transmission);
        }
        if (isset($request->filter_drive)) {
            $queryAds->where('advertisements.drive_type', $request->filter_drive);
        }
        if (isset($request->filter_status)) {
            $queryAds->where('advertisements.type', $request->filter_status);
        }
        if (isset($request->filter_min_year)) {
            $queryAds->where('advertisements.year','>=', $request->filter_min_year);
        }
        if (isset($request->filter_max_year)) {
            $queryAds->where('advertisements.year','<=', $request->filter_max_year);
        }
        if (isset($request->amount_min)) {
            $queryAds->where('advertisements.value','>=', $request->amount_min);
        }
        if (isset($request->amount_max)) {
            $queryAds->where('advertisements.value','<=', $request->amount_max);
        }

        if (isset($request->miles_min)) {
            $queryAds->where('advertisements.miles','>=', $request->amount_min);
        }
        if (isset($request->miles_max)) {
            $queryAds->where('advertisements.miles','<=', $request->amount_max);
        }

        $listAds = $queryAds->get();

        return view('pages.car-list', [
            'listAds' => $listAds,
            /*
            'home' => $home,
            'categories' => $categories,
            'featured' => $featured,
            'products' => $products,
            'total_content' => $total_content,
            'last_contents' => $last_contents,
            */
        ]);
    }

    public function contact(Request $request)
    {
        return view('pages.contact', []);
    }

    public function dealerPlan(Request $request)
    {
        return view('pages.dealer-plan', []);
    }

    public function personPlan(Request $request)
    {
        return view('pages.person-plan', []);
    }

    public function benefits(Request $request)
    {
        return view('pages.benefits', []);
    }
    public function fraudAwareness(Request $request)
    {
        return view('pages.fraud-awareness', []);
    }
    public function termsOfService(Request $request)
    {
        return view('pages.terms-of-service', []);
    }
    public function privacyPolice(Request $request)
    {
        return view('pages.privacy-police', []);
    }
    public function about(Request $request)
    {
        return view('pages.about', []);
    }
    public function dallasHistory(Request $request)
    {
        return view('pages.dallas-history', []);
    }
}
