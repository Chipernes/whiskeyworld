<?php

namespace controllers;

use core\Controller;
use models\Orders;

class StatisticsController extends Controller
{
    public function indexAction()
    {
        $orders = Orders::getOrders();
        return $this->render(null,
            [
                'orders' => $orders,
            ]);
    }
}