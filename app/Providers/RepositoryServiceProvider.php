<?php

namespace App\Providers;

use App\Repositories\Abstracts\BaseRepositoryInterface;
use App\Repositories\Abstracts\TransferRepositoryInterface;
use App\Repositories\Abstracts\UserRepositoryInterface;
use App\Repositories\BaseBaseRepository;
use App\Repositories\TransferRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected array $mappings = [
        BaseRepositoryInterface::class => BaseBaseRepository::class,
        TransferRepositoryInterface::class => TransferRepositoryEloquent::class,
        UserRepositoryInterface::class => UserRepositoryEloquent::class
    ];

    public function register(): void
    {
        foreach ($this->mappings as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }
}
