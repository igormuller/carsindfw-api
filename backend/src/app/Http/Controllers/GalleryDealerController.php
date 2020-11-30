<?php

namespace App\Http\Controllers;

use App\Services\Dealer\DealerService;
use App\Services\Dealer\GalleryDealerService;
use Illuminate\Http\Request;

class GalleryDealerController extends Controller
{
    public function store(Request $request, $delaer_id)
    {
        $service = new DealerService();
        $dealer = $service->find($delaer_id);

        $gallery = new GalleryDealerService();
        $data = $request->all();
        $data = $data['gallery'] ?? $data;
        $gallery->uploadGallery($data, $dealer);

        return $gallery->getGalleryData($dealer);
    }
}
