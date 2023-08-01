<?php

namespace App\Providers;

use App\Services\Abstracts\TransferServiceInterface;
use App\Services\TransferServiceEloquent;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected array $mappings = [
        TransferServiceInterface::class => TransferServiceEloquent::class,
    ];

    public function register(): void
    {
        foreach ($this->mappings as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }
}
