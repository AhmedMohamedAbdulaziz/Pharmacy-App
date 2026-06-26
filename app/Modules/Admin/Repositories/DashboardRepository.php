<?php
namespace App\Modules\Admin\Repositories;

use App\Modules\Admin\Interfaces\DashboardRepositoryInterface;
use App\Modules\Medicine\Models\Medicine;
use App\Modules\Category\Models\Category;
use App\Modules\Supplier\Models\Supplier;
use App\Modules\Order\Models\Order;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function getStats(): array
    {
        return [
            'medicines'  => Medicine::count(),
            'categories' => Category::count(),
            'suppliers'  => Supplier::count(),
            'orders'     => Order::count(),
        ];
    }

    public function getRecentOrders(int $limit = 5)
    {
        return Order::with(['user', 'medicine'])->latest()->take($limit)->get();
    }
}
