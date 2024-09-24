<?php

namespace App\Services\Interface;

interface CourierService
{
    public function track($tracking_number);
    public function createOrder(array $order);
    public function generateLoadsheet();
    public function getCities();
}
