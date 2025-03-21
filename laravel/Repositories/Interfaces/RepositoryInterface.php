<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function paginate(int $perPage = 10);

    public function find(int $id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete(int $id);
}
