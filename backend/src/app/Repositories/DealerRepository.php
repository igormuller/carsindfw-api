<?php

namespace App\Repositories;

use App\Models\Dealer;

class DealerRepository extends BaseRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Dealer();
        parent::__construct($this->entity);
    }

    public function all()
    {
        return $this->entity->all();
    }
}
