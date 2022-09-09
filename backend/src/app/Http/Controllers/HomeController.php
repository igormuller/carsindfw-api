<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\CarMake;
use App\Models\FeaturedAdvertisement;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $listMakes = CarMake::orderBy('name','ASC')->get();
        $listFeaturedAds = FeaturedAdvertisement::with('advertisement')->where('expires_in', '>=', date('Y-m-d H:i:s'))->get();

        return view('pages.home', compact('listMakes', 'listFeaturedAds'));
    }
}
