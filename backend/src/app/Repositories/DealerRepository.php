<?php

namespace App\Repositories;

use App\Models\Dealer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function findByCompany(int $companyID) : Dealer
    {
        $model = $this->entity->where('company_id', $companyID)->first();
        if (empty($model)) {
            throw (new ModelNotFoundException())->setModel(get_class($model), $companyID);
        }

        return $model;
    }
}
