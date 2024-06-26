<?php

namespace controllers;

use core\Controller;
use models\Categories;

class MainController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction() {
        $categories = Categories::getCategories();
        return $this->render(null,
            [
                'categories' => $categories
            ]);
    }

    public function errorAction($code) {
        switch ($code) {
            case 403:
                $title = 'Помилка 403';
                $errorText = 'Помилка 403. Доступ заборонено!';
                return $this->render('views/main/error.php',
                    [
                        'title' => $title,
                        'errorText' => $errorText
                    ]);
            break;

            case 404:
                $title = 'Помилка 404';
                $errorText = 'Помилка 404. Сторінку не знайдено!';
                return $this->render('views/main/error.php',
                [
                    'title' => $title,
                    'errorText' => $errorText
                ]);
                break;
        }
    }
}