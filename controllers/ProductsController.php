<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Categories;
use models\Products;
use models\User;

class ProductsController extends Controller
{
    public function indexAction()
    {
        return $this->render();
    }

    public function addAction($params)
    {
        $categoryId = intval($params[0]);
        if (empty($categoryId))
            $categoryId = null;

        $categories = Categories::getCategories();

        if (Core::getInstance()->requestMethod == 'POST') {
            $errors = [];
            if (empty($_POST['CategoryId']))
                $errors['CategoryId'] = 'Категорія не вибрана';
            if (empty($_POST['Name']))
                $errors['Name'] = 'Назва алкоголю не вказана';
            if (empty($_POST['Color']))
                $errors['Color'] = 'Колір алкоголю не вказаний';
            if ($_POST['Volume'] <= 0)
                $errors['Volume'] = 'Об\'єм алкоголю не вказаний коректно';
            if ($_POST['Strength'] <= 0)
                $errors['Strength'] = 'Міцність алкоголю не вказана коректно';
            if (empty($_POST['Taste']))
                $errors['Taste'] = 'Смак алкоголю не вказаний';
            if ($_POST['Price'] <= 0)
                $errors['Price'] = 'Ціна алкоголю не вказана коректно';
            if ($_POST['Count'] <= 0)
                $errors['Count'] = 'Кількість алкоголю не вказаний коректно';

            if (empty($errors)) {
                $valuesArray = [
                    'CategoryId' => $_POST['CategoryId'],
                    'Name' => $_POST['Name'],
                    'Type' => $_POST['Type'],
                    'Color' => $_POST['Color'],
                    'BrandId' => $_POST['BrandId'],
                    'Volume' => $_POST['Volume'],
                    'Strength' => $_POST['Strength'],
                    'Taste' => $_POST['Taste'],
                    'GrapeVarietyId' => $_POST['GrapeVarietyId'],
                    'Aging' => $_POST['Aging'],
                    'Description' => $_POST['Description'],
                    'Count' => $_POST['Count'],
                    'Price' => $_POST['Price'],
                    'Visibility' => $_POST['Visibility']
                ];

                foreach ($valuesArray as $item => $value) {
                    if ($value == '')
                        $valuesArray[$item] = null;
                }

                Products::addProduct($valuesArray, $_FILES['file']['tmp_name']);

                $this->redirect('/products');
            } else {
                return $this->render(null,
                    [
                        'errors' => $errors,
                        'model' => $_POST,
                        'categories' => $categories,
                        'categoryId' => $categoryId
                    ]);
            }
        }

        return $this->render(null,
            [
                'categories' => $categories,
                '$categoryId' => $categoryId
            ]);
    }

    public function viewAction($params)
    {
        $id = intval($params[0]);
        $product = Products::getProductById($id);

        return $this->render(null,
            [
                'product' => $product
            ]);
    }

    public function editAction($params)
    {
        $id = intval($params[0]);
        if (!User::isAdmin() || $id <= 0)
            return $this->error(403);

        $categories = Categories::getCategoryById($id);

        if (Core::getInstance()->requestMethod == 'POST') {
            $errors = [];
            if (empty($_POST['name']))
                $errors['name'] = 'Назва категорії не вказана';

            if (empty($errors)) {
                Categories::updateCategory($id, $_POST['name']);
                if (!empty($_FILES['file']['tmp_name']))
                    Categories::changeImage($id, $_FILES['file']['tmp_name']);

                $this->redirect('/categories/index');
            } else {
                $model = $_POST;
                return $this->render(null,
                    [
                        'errors' => $errors,
                        'model' => $model,
                        'categories' => $categories,
                    ]);
            }
        }

        return $this->render(null,
            [
                'categories' => $categories,
            ]);
    }
}