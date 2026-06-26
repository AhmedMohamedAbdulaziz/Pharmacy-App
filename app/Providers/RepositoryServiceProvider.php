<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// ── Auth Module ───────────────────────────────────────────────────────────────
use App\Modules\Auth\Interfaces\UserRepositoryInterface;
use App\Modules\Auth\Repositories\UserRepository;
use App\Modules\Auth\Services\AuthService;

// ── Medicine Module ───────────────────────────────────────────────────────────
use App\Modules\Medicine\Interfaces\MedicineRepositoryInterface;
use App\Modules\Medicine\Repositories\MedicineRepository;
use App\Modules\Medicine\Services\MedicineService;

// ── Category Module ───────────────────────────────────────────────────────────
use App\Modules\Category\Interfaces\CategoryRepositoryInterface;
use App\Modules\Category\Repositories\CategoryRepository;
use App\Modules\Category\Services\CategoryService;

// ── Supplier Module ───────────────────────────────────────────────────────────
use App\Modules\Supplier\Interfaces\SupplierRepositoryInterface;
use App\Modules\Supplier\Repositories\SupplierRepository;
use App\Modules\Supplier\Services\SupplierService;

// ── Order Module ──────────────────────────────────────────────────────────────
use App\Modules\Order\Interfaces\OrderRepositoryInterface;
use App\Modules\Order\Repositories\OrderRepository;
use App\Modules\Order\Services\OrderService;

// ── Admin / Dashboard Module ──────────────────────────────────────────────────
use App\Modules\Admin\Interfaces\DashboardRepositoryInterface;
use App\Modules\Admin\Repositories\DashboardRepository;
use App\Modules\Admin\Services\DashboardService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register module bindings.
     *
     * Architecture: Controller → Service → Repository (via Interface) → Model
     *
     * Each module is self-contained under app/Modules/{Name}/ with:
     *   ├── Controllers/
     *   ├── Services/
     *   ├── Interfaces/
     *   ├── Repositories/
     *   ├── Requests/
     *   └── Models/
     */
    public function register(): void
    {
        // ── Auth ─────────────────────────────────────────────────────────────
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthService::class, fn ($app) =>
            new AuthService($app->make(UserRepositoryInterface::class))
        );

        // ── Medicine ─────────────────────────────────────────────────────────
        $this->app->bind(MedicineRepositoryInterface::class, MedicineRepository::class);
        $this->app->bind(MedicineService::class, fn ($app) =>
            new MedicineService($app->make(MedicineRepositoryInterface::class))
        );

        // ── Category ─────────────────────────────────────────────────────────
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryService::class, fn ($app) =>
            new CategoryService($app->make(CategoryRepositoryInterface::class))
        );

        // ── Supplier ─────────────────────────────────────────────────────────
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(SupplierService::class, fn ($app) =>
            new SupplierService($app->make(SupplierRepositoryInterface::class))
        );

        // ── Order ─────────────────────────────────────────────────────────────
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderService::class, fn ($app) =>
            new OrderService($app->make(OrderRepositoryInterface::class))
        );

        // ── Admin / Dashboard ─────────────────────────────────────────────────
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
        $this->app->bind(DashboardService::class, fn ($app) =>
            new DashboardService($app->make(DashboardRepositoryInterface::class))
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
