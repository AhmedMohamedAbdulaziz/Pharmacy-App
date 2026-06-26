<?php
namespace App\Modules\Admin\Services;

use App\Modules\Admin\Interfaces\DashboardRepositoryInterface;

class DashboardService
{
    public function __construct(protected DashboardRepositoryInterface $dashboardRepo) {}

    public function getStats(): array
    {
        return $this->dashboardRepo->getStats();
    }

    public function getRecentOrders(int $limit = 5)
    {
        return $this->dashboardRepo->getRecentOrders($limit);
    }
}
