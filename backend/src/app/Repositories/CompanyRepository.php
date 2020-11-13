<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Company();
    }

    public function create(Array $data): Company
    {
        return $this->entity->create($data);
    }

    public function getModelType(Company $company)
    {
        return $company->thisType();
    }

    public function getDetailShow(Company $company)
    {
        $entity = $this->getModelType($company);
        $entity->type = $company->type;
        $data = $entity->load(
            [
                'address',
                'address.city',
                'address.state',
            ]
        )->toArray();
        return $data;
    }
}
