<?php

namespace App\Repositories\Abstracts;

interface BaseRepositoryInterface
{
    public function findByColumn($field, $column);
    public function create(array $fields);
}
