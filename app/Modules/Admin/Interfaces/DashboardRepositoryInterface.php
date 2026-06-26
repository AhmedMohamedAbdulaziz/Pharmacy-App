<?php
namespace App\Modules\Admin\Interfaces;

interface DashboardRepositoryInterface
{
    public function getStats(): array;
    public function getRecentOrders(int $limit = 5);
}
