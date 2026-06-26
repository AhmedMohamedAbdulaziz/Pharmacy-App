<?php
namespace App\Modules\Order\Repositories;

use App\Modules\Order\Interfaces\OrderRepositoryInterface;
use App\Modules\Order\Models\Order;
use App\Modules\Medicine\Models\Medicine;
use Illuminate\Support\Facades\Auth;

class OrderRepository implements OrderRepositoryInterface
{
    public function createOrder(array $data)
    {
        $medicine = Medicine::findOrFail($data['medicine_id']);
        $medicine->decrement('quantity', $data['quantity']);

        return Order::create([
            'user_id'     => Auth::id(),
            'medicine_id' => $medicine->id,
            'quantity'    => $data['quantity'],
            'total_price' => $medicine->price * $data['quantity'],
        ]);
    }

    public function getAllOrders()
    {
        return Order::with(['user', 'medicine'])->latest()->get();
    }
}
