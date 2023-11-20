<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Brands;
use models\Cart;
use models\Categories;
use models\User;

class BrandsController extends Controller
{
    public function indexAction()
    {
        if (!User::isAdmin())
            return $this->error(403);

        $brands = Brands::getBrands();

        return $this->render(null,
            [
                'brands' => $brands
            ]);
    }

    public function addAction($params)
    {
        if (!User::isAdmin())
            return $this->error(403);

        if (Core::getInstance()->requestMethod == 'POST') {
            $_POST['name'] = trim($_POST['name']);
            $_POST['country'] = trim($_POST['country']);

            $errors = [];
            if (empty($_POST['name']))
                $errors['name'] = 'Назва бренда не вказана';
            if (empty($_POST['country']))
                $errors['country'] = 'Країна реїстрації бренда не вказана';

            if (empty($errors)) {
                Brands::addBrand($_POST['name'], $_POST['country']);
                $this->redirect('/brands');
            } else {
                return $this->render(null,
                    [
                        'errors' => $errors,
                        'model' => $_POST
                    ]);
            }
        }

        return $this->render();
    }

    public function editAction()
    {
        if (!User::isAdmin())
            return $this->error(403);

        $brands = Brands::getBrands();

        $errors = [];
        if (empty($_GET['name']))
            $errors['name'] = 'Назва бренда не вказана';
        if (empty($_GET['country']))
            $errors['country'] = 'Країна реїстрації бренда не вказана';

        if ($_GET['check'] == 'false') {
            $errors = 1;
        }

        if (empty($errors)) {
            Brands::updateBrand(
                $_GET['brandId'],
                [
                    'Name' => $_GET['name'],
                    'Country' => $_GET['country']
                ]);

            $this->redirect('/brands');
        } else {
            $model = $_GET;
            return $this->render(null,
                [
                    'model' => $model,
                    'errors' => $errors,
                    'brands' => $brands,
                ]);
        }


        return $this->render(null,
            [
                'brands' => $brands,
            ]);
    }

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        $yes = boolval($params[1] == 'yes');
        if (!User::isAdmin())
            return $this->error(403);

        $brands = Brands::getBrands();
        if ($yes) {
            Brands::deleteBrand($id);
            $this->redirect('/brands');
        }

        return $this->render(null,
            [
                'brands' => $brands,
            ]);
    }
}