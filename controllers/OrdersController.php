<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\OrderItems;
use models\Orders;
use models\Products;
use models\Statuses;
use models\User;

class OrdersController extends Controller
{
    public function indexAction()
    {
        $orders = Orders::getOrders();
        $joinedOrdersWithUsers = Orders::getJoinedOrdersWithUsers();
        $joinedOrdersWithStatuses = Orders::getJoinedOrdersWithStatuses();
        return $this->render(null,
            [
                'orders' => $orders,
                'joinedOrdersWithUsers' => $joinedOrdersWithUsers,
                'joinedOrdersWithStatuses' => $joinedOrdersWithStatuses,
            ]
        );
    }

    public function viewAction($params)
    {
        $orderId = intval($params[0]);

        $orderItems = OrderItems::getOrderItemByOrderId($orderId);
        $joinedOrdersWithUsers = Orders::getJoinedOrdersWithUsers();
        $totalPrice = OrderItems::getTotalPrice();
        $statuses = Statuses::getStatuses();
        $orders = Orders::getOrders();
        $products = Products::getAllProduct();
        return $this->render(null,
            [
                'orderItems' => $orderItems,
                'joinedOrdersWithUsers' => $joinedOrdersWithUsers,
                'totalPrice' => $totalPrice,
                'statuses' => $statuses,
                'orders' => $orders,
                'products' => $products,
            ]
        );
    }

    public function editAction()
    {
        if (!User::isAdmin())
            return $this->error(403);

        if (Core::getInstance()->requestMethod == 'GET') {
            if (!empty($_GET['newStatus'])) {
                $newStatus = $_GET['newStatus'];
            }

            if (!empty($_GET['orderId'])) {
                $orderId = $_GET['orderId'];
            }

            Orders::updateOrderItem($orderId, ['StatusId' => $newStatus]);

            $this->redirect("/orders/view/{$orderId}");
        }

        return $this->render();
    }
}