<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Cart;
use models\OrderItems;
use models\Orders;
use models\Products;
use models\User;

class OrderItemsController extends Controller
{
    public function indexAction()
    {
        return $this->render();
    }

    public function addAction()
    {
        if (!User::isUserAuthenticated())
            $this->redirect('/user/login');

        if (Core::getInstance()->requestMethod == 'GET') {
            $currentUserId = User::getCurrentAuthenticatedUser()['UserId'];
            Orders::addOrder($currentUserId, date("Y-m-d"));

            $lastOrderId =  Orders::getaLastOrderId();

            if (!empty($_GET['productNames'])) {
                $productNames = explode(',', $_GET['productNames']);
            }

            if (!empty($_GET['productPrices'])) {
                $productPrices = explode(',', $_GET['productPrices']);
            }

            if (!empty($_GET['productCounts'])) {
                $productCounts = explode(',', $_GET['productCounts']);
            }

            if (!empty($_GET['phone'])) {
                $phone = explode(',', $_GET['phone']);
            }

            for ($i = 0; $i < count($productNames); $i += 1) {
                $productId =  Products::getProductIdByName($productNames[$i]);

                OrderItems::addOrderItem($lastOrderId, $productId, $productCounts[$i], $productPrices[$i]);
                User::updateUser($currentUserId, ['PhoneNumber' => $phone[0]]);

                $currentProduct = Products::getProductById($productId);
                Products::updateProduct($productId, ['Count' => $currentProduct['Count'] - intval($productCounts[$i])]);
            }

            Cart::resetCart();

            $this->redirect('/products');
        }

        return $this->render();
    }
}