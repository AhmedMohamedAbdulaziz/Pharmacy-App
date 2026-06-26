<?php
namespace App\Modules\Order\Services;

use App\Modules\Order\Interfaces\OrderRepositoryInterface;

class OrderService
{
    public function __construct(protected OrderRepositoryInterface $orderRepo) {}

    public function buy(array $data)       { return $this->orderRepo->createOrder($data); }
    public function getAllOrders()         { return $this->orderRepo->getAllOrders(); }
}
