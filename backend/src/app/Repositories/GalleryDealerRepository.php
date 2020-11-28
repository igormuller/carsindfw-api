<?php

namespace App\Repositories;

use App\Models\GalleryDealer;

class GalleryDealerRepository extends BaseRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new GalleryDealer();
        parent::__construct($this->entity);
    }

    public function all()
    {
        return $this->entity->all();
    }
}
