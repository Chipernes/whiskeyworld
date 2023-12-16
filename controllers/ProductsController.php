<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Brands;
use models\Cart;
use models\Categories;
use models\GrapeVarieties;
use models\Products;
use models\SugarContents;
use models\User;

class ProductsController extends Controller
{
    public function indexAction()
    {
        $brands = Brands::getBrands();
        $products = Products::getAllProduct();
        $groupedProductsByTypes = Products::getGroupedProduct('Type', ['Type' => 'IS NOT Null'], 'Type');
        $groupedProductsByValues = Products::getGroupedProduct('Volume', null, 'Volume');
        $groupedCountries = Brands::getGroupedBrand('Country');

        $filteredProducts = Products::getJoinedProductWithCategory();
        if (count($_GET) > 1) {
            $brandFilter = isset($_GET['brand']) ? explode(',', $_GET['brand']) : [];
            $typeFilter = isset($_GET['type']) ? explode(',', $_GET['type']) : [];
            $valueFilter = isset($_GET['value']) ? explode(',', $_GET['value']) : [];
            $agingFilter = isset($_GET['aging']) ? explode(',', $_GET['aging']) : [];
            $countryFilter = isset($_GET['country']) ? explode(',', $_GET['country']) : [];

            $filters = [
                'brand'   => $brandFilter,
                'type'    => $typeFilter,
                'value'   => $valueFilter,
                'aging'   => $agingFilter,
                'country' => $countryFilter,
            ];

            $filteredProducts = Products::filterProducts($filters);
        }

        return $this->render(null, [
            'brands' => $brands,
            'products' => $products,
            'groupedProductsByTypes' => $groupedProductsByTypes,
            'groupedProductsByValues' => $groupedProductsByValues,
            'groupedCountries' => $groupedCountries,
            'filteredProducts' => $filteredProducts,
        ]);
    }

    public function addAction($params)
    {
        if (!User::isAdmin())
            return $this->error(403);

        $categoryId = intval($params[0]);
        if (empty($categoryId))
            $categoryId = null;

        $categories = Categories::getCategories();
        $grapeVarieties = GrapeVarieties::getGrapeVarieties();
        $brands = Brands::getBrands();
        $sugarContents = SugarContents::getSugarContents();

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
                    'SugarContentId' => $_POST['SugarContentId'],
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
                'brands' => $brands,
                'sugarContents' => $sugarContents,
            ]);
    }

    public function viewAction($params)
    {
        $id = intval($params[0]);
        $product = Products::getProductById($id);
        $category = Categories::getCategoryById($product['CategoryId']);
        $brand = Brands::getBrandById($product['BrandId']);
        $grapeVariety = GrapeVarieties::getGrapeVarietyById($product['GrapeVarietyId']);
        $sugarContent = SugarContents::getSugarContentById($product['SugarContentId']);

        return $this->render(null,
            [
                'product' => $product,
                'category' => $category,
                'brand' => $brand,
                'grapeVariety' => $grapeVariety,
                'sugarContent' => $sugarContent,
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
        $categoryId = $product['CategoryId'];
        $sugarContents = SugarContents::getSugarContents();

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
                    'SugarContentId' => $_POST['SugarContentId'],
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
                'brands' => $brands,
                'product' => $product,
                'sugarContents' => $sugarContents,
            ]);

    }

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        $yes = boolval($params[1] == 'yes');
        if (!User::isAdmin() || $id <= 0)
            return $this->error(403);

        $product = Products::getProductById($id);

        if ($yes) {
            $filePath = 'files/categories/' . $product['Image'];
            if (is_file($filePath))
                unlink($filePath);

            Products::deleteProduct($id);

            $this->redirect("/categories/view/{$product['CategoriesId']}");
        }

        return $this->render(null,
            [
                'product' => $product
            ]);
    }
}