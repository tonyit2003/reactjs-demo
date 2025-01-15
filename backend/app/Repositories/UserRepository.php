<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository implements \App\Repositories\Interfaces\UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
        parent::__construct($this->model);
    }
}
