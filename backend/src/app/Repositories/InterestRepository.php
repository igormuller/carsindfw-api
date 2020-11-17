<?php

namespace App\Repositories;

use App\Models\Interest;
use Illuminate\Support\Collection;

class InterestRepository extends BaseRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Interest();
        parent::__construct($this->entity);
    }

    public function all()
    {
        return $this->entity->all();
    }

    public function hasRegister(int $advertisement_id, string $email = null, string $phone = null) : Collection
    {
        $interests = $this->entity->where('advertisement_id', $advertisement_id);

        if ($email) {
            $interests = $interests->where('email', $email);
        }

        if ($phone) {
            $interests = $interests->where('phone', $phone);
        }

        return $interests->get();
    }
}
