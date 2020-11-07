<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    private $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function create(Array $data): Model
    {
        return $this->entity->create($data);
    }

    public function findOrFail(int $id) :? Model
    {
        return $this->entity->findOrFail($id);
    }

    public function delete(Model $entity) : bool
    {
        return $entity->delete();
    }
}
