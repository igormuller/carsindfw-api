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

    public function all(int $advertisement_id)
    {
        return $this->entity->where('advertisement_id', $advertisement_id)->orderBy('default', 'desc')->get();
    }

    public function getDefault(int $advertisement_id)
    {
        return $this->entity->where('advertisement_id', $advertisement_id)
                            ->where('default', true)
                            ->first();
    }
}
