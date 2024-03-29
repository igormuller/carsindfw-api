<?php

namespace App\Repositories;

use App\Enums\EnumCarModelDescription;
use App\Models\Advertisement;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class AdvertisementRepository extends BaseRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Advertisement();
        parent::__construct($this->entity);
    }

    public function getAllInfo(): array
    {
        $data = $this->entity->all();

        $data = $data->map(function($item) {
            $item->make_name = $item->carMake->getName();
            $item->model_name = $item->carModel->getName();
            return $item;
        });

        return $data->toArray();
    }

    public function getLastCreatedAt(int $limit = null): Collection
    {
        if (empty($limit)) {
            return $this->entity->all()->last();
        }
        return $this->entity->all()->sortByDesc('created_at')->take($limit);
    }

    function getURLPhoto(Advertisement $entity):? string
    {
        $photo = $entity->gallery->sortByDesc('default')->first();
        return !empty($photo) ? Storage::url($photo->path) : null;
    }

    public function getGalleryData(Advertisement $entity) : Collection
    {
        $gallery = $entity->gallery->sortByDesc('default');
        $mapped = $gallery->map(function ($item) {
            $item->url = Storage::url($item->path);
            return $item;
        });
        return $mapped->values();
    }

    public function getEntityData(Advertisement $entity) : Advertisement
    {
        $entity->make_name          = $entity->carMake->getName();
        $entity->model_name         = $entity->carModel->getName();
        $entity->body_type_front    = $entity->body_type;
        $entity->fuel_type_front    = EnumCarModelDescription::getFuelTypeName($entity->fuel_type);
        $entity->transmission_front = $entity->transmission . " - " .
                                      EnumCarModelDescription::getTransmissionTypeName($entity->transmission_type);
        $entity->features           = !empty($entity->features) ? explode(',', $entity->features) : null;
        $entity->type_front         = ucfirst($entity->type);
        $entity->show_name          = $entity->year . ' ' . $entity->make_name . ' ' . $entity->model_name;
        $entity->name_detail_front  = ucfirst($entity->color_ext) . ' / ' . $entity->engine . ' / ' .
                                      $entity->drive_type;
        return $entity->load('carDescription');
    }
}
