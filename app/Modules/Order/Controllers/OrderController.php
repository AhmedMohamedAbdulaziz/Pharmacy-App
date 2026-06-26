<?php
namespace App\Modules\Order\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Order\Requests\BuyMedicineRequest;
use App\Modules\Order\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService) {}

    public function buy(BuyMedicineRequest $request)
    {
        $this->orderService->buy($request->validated());
        return redirect()->route('medicines.index')->with('success', 'Medicine purchased successfully.');
    }
}
