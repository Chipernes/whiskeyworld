<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Brands;
use models\Categories;
use models\GrapeVarieties;
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
        $grapeVarieties = GrapeVarieties::getGrapeVarieties();
        $brands = Brands::getBrands();

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

                $this->redirect("/categories/view/$categoryId");
            } else {
                return $this->render(null,
                    [
                        'errors' => $errors,
                        'model' => $_POST,
                        'categories' => $categories
                    ]);
            }
        }

        return $this->render(null,
            [
                'categories' => $categories,
                'categoryId' => $categoryId,
                'grapeVarieties' => $grapeVarieties,
                'brands' => $brands
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

        $categories = Categories::getCategories();
        $grapeVarieties = GrapeVarieties::getGrapeVarieties();
        $brands = Brands::getBrands();
        $product = Products::getProductById($id);

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

                Products::updateProduct($id, $valuesArray);
                if (!empty($_FILES['file']['tmp_name']))
                    Products::changeImage($id, $_FILES['file']['tmp_name']);

                $this->redirect("/categories/view/$id");
            } else {
                return $this->render(null,
                    [
                        'errors' => $errors,
                        'model' => $_POST,
                        'categories' => $categories
                    ]);
            }
        }

        return $this->render(null,
            [
                'categories' => $categories,
                'categoryId' => $id,
                'grapeVarieties' => $grapeVarieties,
                'brands' => $brands,
                'product' => $product
            ]);

    }
}