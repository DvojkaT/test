<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Abstracts\UserRepositoryInterface;

class UserRepositoryEloquent extends BaseBaseRepository implements UserRepositoryInterface
{
    function model(): string
    {
        return User::class;
    }

    public function getUserById(int $id): User
    {
        return $this->findByColumn('id', $id)->first();
    }
}
