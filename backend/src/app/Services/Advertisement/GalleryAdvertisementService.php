<?php

namespace App\Services\Advertisement;

use App\Models\Advertisement;
use App\Models\GalleryAdvertisement;
use App\Repositories\GalleryAdvertisementRepository;
use App\Services\General\StorageService;
use Illuminate\Support\Collection;

class GalleryAdvertisementService
{
    private $repository;
    private $storage;

    public function __construct()
    {
        $this->repository = new GalleryAdvertisementRepository();
        $this->storage = new StorageService();
    }

    public function find(int $id) : GalleryAdvertisement
    {
        return $this->repository->findOrFail($id);
    }

    public function uploadGallery(array $images, Advertisement $advertisement) : Collection
    {
        $this->removeDiference($images, $advertisement);
        foreach ($images as $image) {
            if (empty($image['file'])) {
                continue;
            }
            $path = "/advertisement/".$advertisement->id;
            $path = $this->storage->upload($image['file'], $path);
            $this->repository->create(['advertisement_id'=>$advertisement->id, 'path'=>$path]);
        }
        $advertisement->refresh();
        return $this->getGalleryData($advertisement);
    }

    public function getGalleryData(Advertisement $entity) : Collection
    {
        return $entity->gallery->map(function ($item) {
            $item->url = $this->storage->getURL($item->path);
            return $item;
        });
    }

    public function galleryData(Collection $gallery)
    {
        return $gallery->map(function ($item) {
            $item->url = $this->storage->getURL($item->path);
            return $item;
        });
    }

    public function getGalerry(int $advertisemtn_id) : Collection
    {
        $images = $this->repository->all($advertisemtn_id);
        return $this->galleryData($images);
    }

    public function removeDiference(array $images, Advertisement $advertisement)
    {
        $galleryAdvertisement = $advertisement->gallery;
        foreach ($images as $image) {
            if (!empty($image['path'])) {
                $galleryAdvertisement = $galleryAdvertisement->where('path', '<>', $image['path']);
            }
        }

        foreach ($galleryAdvertisement as $image) {
            $this->removeImage($image);
        }
    }

    public function removeImage(GalleryAdvertisement $image)
    {
        $this->storage->delete($image->path);
        $image->delete();
    }

    public function setDefault(GalleryAdvertisement $image)
    {
        $imageDefault = $this->repository->getDefault($image->advertisement_id);
        if (!empty($imageDefault)) {
            $imageDefault->default = false;
            $imageDefault->save();
        }

        $image->default = true;
        $image->save();
    }
}
