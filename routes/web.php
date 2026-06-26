<?php

use Illuminate\Support\Facades\Route;

// ── Module Controllers ────────────────────────────────────────────────────────
use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Medicine\Controllers\MedicineController;
use App\Modules\Category\Controllers\CategoryController;
use App\Modules\Supplier\Controllers\SupplierController;
use App\Modules\Order\Controllers\OrderController;
use App\Modules\Admin\Controllers\DashboardController;

// Root redirect
Route::get('/', fn () => redirect()->route('medicines.index'));

// ── Guest Routes ──────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('login',    [AuthController::class, 'login'])->name('login.submit');
    Route::get('register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.submit');
});

// ── Authenticated Routes ──────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Medicine shop (all authenticated users)
    Route::get('medicines',      [MedicineController::class, 'index'])->name('medicines.index');
    Route::get('medicines/{id}', [MedicineController::class, 'show'])->name('medicines.show');
    Route::post('buy',           [OrderController::class,    'buy'])->name('medicines.buy');

    // ── Admin-only Routes ─────────────────────────────────────────────────────
    Route::middleware('admin')->prefix('admin')->group(function () {

        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Medicine CRUD (create / store / edit / update / destroy)
        Route::resource('medicines', MedicineController::class)->except(['index', 'show']);

        // Category & Supplier full CRUD
        Route::resource('categories', CategoryController::class);
        Route::resource('suppliers',  SupplierController::class);
    });
});
