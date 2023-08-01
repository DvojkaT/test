<?php

namespace App\Repositories;

use App\Repositories\Abstracts\BaseRepositoryInterface;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Exceptions\RepositoryException;

abstract class BaseBaseRepository implements BaseRepositoryInterface
{
    protected $model;

    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract function model(): string;

    public function getModel(): string
    {
        return $this->model;
    }

    public function makeModel()
    {
        $model = $this->app->make($this->model());

        return $this->model = $model;
    }

    public function findByColumn($field, $column)
    {
        return $this->model->where($field, '=', $column)->get();
    }

    public function create(array $fields)
    {
        return $this->model->create($fields);
    }
}
