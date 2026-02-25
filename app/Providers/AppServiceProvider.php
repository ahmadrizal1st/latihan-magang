<?php

namespace App\Providers;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;
use App\Interfaces\CityRepositoryInterface;
use App\Repositories\CityRepository;
use App\Interfaces\EmployeeJobRepositoryInterface;
use App\Repositories\EmployeeJobRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class,
        );

        $this->app->bind(
            CityRepositoryInterface::class,
            CityRepository::class,
        );

        $this->app->bind(
            EmployeeJobRepositoryInterface::class,
            EmployeeJobRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}