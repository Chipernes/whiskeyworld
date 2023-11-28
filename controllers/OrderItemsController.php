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

            for ($i = 0; $i < count($productNames); $i += 1) {
                $productId =  Products::getProductIdByName($productNames[$i]);
                OrderItems::addOrderItem($lastOrderId, $productId, $productCounts[$i], $productPrices[$i]);
            }

            Cart::resetCart();

            $this->redirect('/products');
        }

        return $this->render();
    }

    public function editAction()
    {
        if (!User::isAdmin())
            return $this->error(403);

        $sugarContents = SugarContents::getSugarContents();

        $errors = [];
        if (empty($_GET['name']))
            $errors['name'] = 'Назва класифікації вмісту цукру не вказана';

        if ($_GET['check'] == 'false') {
            $errors = 1;
        }

        if (empty($errors)) {
            SugarContents::updateSugarContent(
                $_GET['sugarContentId'],
                [
                    'Name' => $_GET['name'],
                ]);

            $this->redirect('/sugarContents');
        } else {
            $model = $_GET;
            return $this->render(null,
                [
                    'model' => $model,
                    'errors' => $errors,
                    'sugarContents' => $sugarContents,
                ]);
        }


        return $this->render(null,
            [
                'sugarContents' => $sugarContents,
            ]);
    }

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        $yes = boolval($params[1] == 'yes');
        if (!User::isAdmin())
            return $this->error(403);

        $sugarContents = SugarContents::getSugarContents();
        if ($yes) {
            SugarContents::deleteSugarContent($id);
            $this->redirect('/sugarContents');
        }

        return $this->render(null,
            [
                'sugarContents' => $sugarContents,
            ]);
    }
}