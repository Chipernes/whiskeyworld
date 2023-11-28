<?php

namespace controllers;

use core\Controller;
use models\OrderItems;
use models\Orders;

class OrdersController extends Controller
{
    public function indexAction()
    {
        $orders = Orders::getOrders();
        return $this->render(null, ['orders' => $orders]);
    }

    public function viewAction($params)
    {
        $orderId = intval($params[0]);

        $orderItems = OrderItems::getOrderItemByOrderId($orderId);
        return $this->render(null, ['orderItems' => $orderItems]);
    }
}