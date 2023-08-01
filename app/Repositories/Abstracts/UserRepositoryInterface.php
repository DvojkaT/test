<?php

namespace App\Repositories\Abstracts;

use App\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getUserById(int $id): User;
}
