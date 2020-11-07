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

    function getURLRandomPhoto(Advertisement $entity):? string
    {
        $photo = $entity->gallery->isNotEmpty()? $entity->gallery->random() : null;
        if (!empty($photo)) {
            $photo = Storage::url($photo->path);
        }
        return $photo;
    }

    public function getGalleryData(Advertisement $entity) : Collection
    {
        return $entity->gallery->map(function ($item) {
            $item->url = Storage::url($item->path);
            return $item;
        });
    }

    public function getEntityData(Advertisement $entity) : Advertisement
    {
        $entity->make_name          = $entity->carMake->getName();
        $entity->model_name         = $entity->carModel->getName();
        $entity->body_type_front    = EnumCarModelDescription::getBodyTypeName($entity->body_type);
        $entity->fuel_type_front    = EnumCarModelDescription::getFuelTypeName($entity->fuel_type);
        $entity->transmission_front = $entity->transmission . " - " .
                                      EnumCarModelDescription::getTransmissionTypeName($entity->transmission_type);
        $entity->features           = explode(',', $entity->features);
        return $entity;
    }

    public function getCompanyData(Advertisement $entity): array
    {
        $type = $entity->company->type;
        return $entity->company->$type->toArray();
    }
}
