<?php
namespace App\Modules\Order\Interfaces;

interface OrderRepositoryInterface
{
    public function createOrder(array $data);
    public function getAllOrders();
}
