<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Brands;
use models\SugarContents;
use models\User;

class SugarContentsController extends Controller
{
    public function indexAction()
    {
        if (!User::isAdmin())
            return $this->error(403);

        $sugarContents = SugarContents::getSugarContents();

        return $this->render(null,
            [
                'sugarContents' => $sugarContents
            ]);
    }

    public function addAction($params)
    {
        if (!User::isAdmin())
            return $this->error(403);

        if (Core::getInstance()->requestMethod == 'POST') {
            $_POST['name'] = trim($_POST['name']);

            $errors = [];
            if (empty($_POST['name']))
                $errors['name'] = 'Назва класифікації вмісту цукру не вказана';
            if (!empty(SugarContents::getSugarContentByName($_POST['name'])))
                $errors['name'] = 'Така класифікація вмісту цукру вже існує';

            if (empty($errors)) {
                SugarContents::addSugarContent($_POST['name']);
                $this->redirect('/sugarContents');
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