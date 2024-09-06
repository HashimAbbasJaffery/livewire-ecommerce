<?php

namespace App\Services\Interface;

interface CourierService
{
    public function track();
    public function createOrder();
    public function generateLoadsheet();
    public function getCities();
}
