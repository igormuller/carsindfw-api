<?php

namespace App\Services\Dealer;

use App\Models\Dealer;
use App\Repositories\GalleryDealerRepository;
use App\Services\General\StorageService;
use Illuminate\Support\Collection;

class GalleryDealerService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new GalleryDealerRepository();
    }
    public function uploadGallery(array $images, Dealer $dealer)
    {
        $this->removeDiference($images, $dealer);
        $storage = new StorageService();
        foreach ($images as $image) {
            if (empty($image['file'])) {
                continue;
            }
            $path = "/dealer/".$dealer->id;
            $path = $storage->upload($image['file'], $path);
            $this->repository->create(['dealer_id'=>$dealer->id, 'path'=>$path]);
        }
        $dealer->refresh();
        return $this->getGalleryData($dealer);
    }

    public function getGalleryData(Dealer $entity) : Collection
    {
        $storage = new StorageService();
        return $entity->gallery->map(function ($item) use ($storage) {
            $item->url = $storage->getURL($item->path);
            return $item;
        });
    }

    public function removeDiference(array $images, Dealer $dealer)
    {
        $galleryDealer = $dealer->gallery;
        foreach ($images as $image) {
            if (!empty($image['path'])) {
                $galleryDealer = $galleryDealer->where('path', '<>', $image['path']);
            }
        }

        $storage = new StorageService();
        foreach ($galleryDealer as $gallery) {
            $storage->delete($gallery->path);
            $gallery->delete();
        }
    }
}
