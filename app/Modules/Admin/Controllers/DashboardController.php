<?php
namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $dashboardService) {}

    public function index()
    {
        $stats        = $this->dashboardService->getStats();
        $recentOrders = $this->dashboardService->getRecentOrders(5);

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
