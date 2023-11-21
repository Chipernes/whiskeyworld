<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Brands;
use models\GrapeVarieties;
use models\User;

class GrapeVarietiesController extends Controller
{
    public function indexAction()
    {
        if (!User::isAdmin())
            return $this->error(403);

        $grapeVarieties = GrapeVarieties::getGrapeVarieties();

        return $this->render(null,
            [
                'grapeVarieties' => $grapeVarieties
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
                $errors['name'] = 'Назва сорту не вказана';
            if (!empty(GrapeVarieties::getGrapeVarietyByName($_POST['name'])))
                $errors['name'] = 'Такий сорт вже існує';

            if (empty($errors)) {
                GrapeVarieties::addGrapeVariety($_POST['name']);
                $this->redirect('/grapeVarieties');
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

        $grapeVarieties = GrapeVarieties::getGrapeVarieties();

        $errors = [];
        if (empty($_GET['name']))
            $errors['name'] = 'Назва бренда не вказана';

        if ($_GET['check'] == 'false') {
            $errors = 1;
        }

        if (empty($errors)) {
            GrapeVarieties::updateGrapeVariety(
                $_GET['grapeVarietyId'],
                [
                    'Name' => $_GET['name'],
                ]
            );

            $this->redirect('/grapeVarieties');
        } else {
            $model = $_GET;
            return $this->render(null,
                [
                    'model' => $model,
                    'errors' => $errors,
                    'grapeVarieties' => $grapeVarieties,
                ]);
        }


        return $this->render(null,
            [
                'grapeVarieties' => $grapeVarieties,
            ]);
    }

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        $yes = boolval($params[1] == 'yes');
        if (!User::isAdmin())
            return $this->error(403);

        $grapeVarieties = GrapeVarieties::getGrapeVarieties();
        if ($yes) {
            GrapeVarieties::deleteGrapeVariety($id);
            $this->redirect('/grapeVarieties');
        }

        return $this->render(null,
            [
                'grapeVarieties' => $grapeVarieties,
            ]);
    }
}