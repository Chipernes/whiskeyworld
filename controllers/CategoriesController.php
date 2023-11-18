<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Categories;
use models\Products;
use models\User;

class CategoriesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $categories = Categories::getCategories();
        return $this->render(null,
            [
                'categories' => $categories
            ]);
    }

    public function addAction()
    {
        if (!User::isAdmin())
            return $this->error(403);

        if (Core::getInstance()->requestMethod == 'POST') {
            $_POST['name'] = trim($_POST['name']);

            $errors = [];
            if (empty($_POST['name']))
                $errors['name'] = 'Назва категорії не вказана';

            if (empty($errors)) {
                Categories::addCategory($_POST['name'], $_FILES['file']['tmp_name']);
                $this->redirect('/categories/index');
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

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        $yes = boolval($params[1] == 'yes');
        if (!User::isAdmin() || $id <= 0)
            return $this->error(403);

        $categories = Categories::getCategoryById($id);
        if ($yes) {

            $filePath = 'files/categories/' . $categories['Image'];
                if (is_file($filePath))
                    unlink($filePath);

            Categories::deleteCategory($id);

            $this->redirect('/categories');
        }

        return $this->render(null,
            [
                'categories' => $categories,
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

    public function viewAction($params)
    {
        $id = intval($params[0]);
        $category = Categories::getCategoryById($id);
        $products = Products::getProductsInCategory($id);

        return $this->render(null,
            [
                'category' => $category,
                'products' => $products
            ]);
    }
}