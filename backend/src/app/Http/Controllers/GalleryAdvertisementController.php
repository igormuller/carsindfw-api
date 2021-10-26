<?php

namespace App\Http\Controllers;

use App\Services\Advertisement\AdvertisementService;
use App\Services\Advertisement\GalleryAdvertisementService;
use Illuminate\Http\Request;

class GalleryAdvertisementController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new GalleryAdvertisementService();
    }

    public function store(Request $request, $advertisement_id)
    {
        $advertisementService = new AdvertisementService();
        $advertisement = $advertisementService->find($advertisement_id);

        $gallery = $request->gallery ?? [];
        return $this->service->uploadGallery($gallery, $advertisement);
    }

    public function default($id)
    {
        $image = $this->service->find($id);
        $this->service->setDefault($image);
        return response('Picture set Default with Success!!!', 200);
    }

    public function getGallery($advertisement_id)
    {
        return $this->service->getGalerry($advertisement_id);
    }

    public function destroy($id)
    {
        $image = $this->service->find($id);
        $this->service->removeImage($image);
        return response('Picture removed with Success!!!', 200);
    }
}
