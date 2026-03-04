<?php

namespace App\Providers;

use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\CounterRepositoryInterface;
use App\Interfaces\DistrictRepositoryInterface;
use App\Interfaces\EmployeeJobRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\ProvinceRepositoryInterface;
use App\Interfaces\SettingRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\VillageRepositoryInterface;
use App\Interfaces\LeaveRequestRepositoryInterface;
use App\Repositories\CityRepository;
use App\Repositories\CounterRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\EmployeeJobRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use App\Repositories\VillageRepository;
use App\Repositories\LeaveRequestRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class ,
            UserRepository::class ,
        );

        $this->app->bind(
            EmployeeRepositoryInterface::class ,
            EmployeeRepository::class ,
        );

        $this->app->bind(
            CityRepositoryInterface::class ,
            CityRepository::class ,
        );

        $this->app->bind(
            EmployeeJobRepositoryInterface::class ,
            EmployeeJobRepository::class ,
        );

        $this->app->bind(
            ProvinceRepositoryInterface::class ,
            ProvinceRepository::class ,
        );

        $this->app->bind(
            DistrictRepositoryInterface::class ,
            DistrictRepository::class ,
        );

        $this->app->bind(
            VillageRepositoryInterface::class ,
            VillageRepository::class ,
        );

        $this->app->bind(
            CounterRepositoryInterface::class ,
            CounterRepository::class ,
        );

        $this->app->bind(
            SettingRepositoryInterface::class ,
            SettingRepository::class ,
        );

        $this->app->bind(
            LeaveRequestRepositoryInterface::class ,
            LeaveRequestRepository::class ,
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