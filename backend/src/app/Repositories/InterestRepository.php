<?php

namespace App\Repositories;

use App\Models\Interest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\This;

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
        $company_id = Auth::user()->company_id;
        $interests = $this->entity->select('interests.*', 'car_makes.name as make_name', 'car_models.name as model_name')
                                  ->join('advertisements', 'interests.advertisement_id', '=', 'advertisements.id')
                                  ->join('car_makes', 'advertisements.car_make_id', '=', 'car_makes.id')
                                  ->join('car_models', 'advertisements.car_model_id', '=', 'car_models.id')
                                  ->where('advertisements.company_id', $company_id)
                                  ->get();
        return $interests;
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
