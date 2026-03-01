<?php

namespace App\Providers;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;
use App\Interfaces\CityRepositoryInterface;
use App\Repositories\CityRepository;
use App\Interfaces\EmployeeJobRepositoryInterface;
use App\Repositories\EmployeeJobRepository;
use App\Interfaces\ProvinceRepositoryInterface;
use App\Repositories\ProvinceRepository;
use App\Interfaces\DistrictRepositoryInterface;
use App\Repositories\DistrictRepository;
use App\Interfaces\VillageRepositoryInterface;
use App\Repositories\VillageRepository;
use App\Interfaces\PostalCodeRepositoryInterface;
use App\Repositories\PostalCodeRepository;
use App\Interfaces\CounterRepositoryInterface;
use App\Repositories\CounterRepository;
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

        $this->app->bind(
            ProvinceRepositoryInterface::class,
            ProvinceRepository::class,
        );

        $this->app->bind(
            DistrictRepositoryInterface::class,
            DistrictRepository::class,
        );

        $this->app->bind(
            VillageRepositoryInterface::class,
            VillageRepository::class,
        );

        $this->app->bind(
            PostalCodeRepositoryInterface::class,
            PostalCodeRepository::class,
        );

        $this->app->bind(
            CounterRepositoryInterface::class,
            CounterRepository::class,
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