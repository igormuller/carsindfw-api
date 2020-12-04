<?php

namespace App\Repositories;

use App\Models\GalleryAdvertisement;

class GalleryAdvertisementRepository extends BaseRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new GalleryAdvertisement();
        parent::__construct($this->entity);
    }

    public function all()
    {
        return $this->entity->all();
    }
}
