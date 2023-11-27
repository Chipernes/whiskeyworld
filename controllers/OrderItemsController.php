<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\OrderItems;
use models\Products;
use models\User;

class OrderItemsController extends Controller
{
    public function indexAction()
    {
        return $this->render();
    }

    public function addAction($params)
    {
        if (!User::isUserAuthenticated())
            $this->redirect('/user/login');

        $yes = boolval($params[0] == 'yes');
        if (Core::getInstance()->requestMethod == 'GET') {
            $productId =  Products::getProductIdByName($_GET['product1Name']);
            OrderItems::addOrderItem(1, $productId, $_GET['product1Count'], $_GET['product1Price']);

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