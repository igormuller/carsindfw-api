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
}
