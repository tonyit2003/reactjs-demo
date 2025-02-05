<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function pagination($page = 1, $perPage = 10);
    public function findById($modelId);
    public function insert($payload = []);
    public function update($id = 0, $payload = []);
}
