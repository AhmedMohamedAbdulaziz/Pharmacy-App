<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\MedicineRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\SupplierRepositoryInterface;
use App\Repositories\MedicineRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SupplierRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            MedicineRepositoryInterface::class,
            MedicineRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            SupplierRepositoryInterface::class,
            SupplierRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
