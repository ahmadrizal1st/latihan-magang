<?php

namespace App\Providers;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;
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
            EmployeeRepository::class
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