<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function pagination($page = 1, $perPage = 10);
}
