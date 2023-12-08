<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Genders;
use models\User;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        if (!User::isAdmin())
            return $this->error(403);

        $users = User::getAllUsers();
        return $this->render(null,
            [
                'users' => $users
            ]);
    }

    public function registerAction()
    {
        if (User::isUserAuthenticated())
            $this->redirect('/');

        if (Core::getInstance()->requestMethod == 'POST') {
            $errors = [];
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                $errors['email'] = 'Помилка при введені електронної пошти';

            if (User::isUserExists('Email', $_POST['email']))
                $errors['email'] = 'Така електронна пошта вже зайнята';

            if (User::isUserExists('Login', $_POST['login']))
                $errors['login'] = 'Такий логін вже зайнятий';

            if ($_POST['password'] != $_POST['passwordRepeat'])
                $errors['password'] = 'Паролі не співпадають';

            if (count($errors) > 0) {
                return $this->render(null,
                    [
                        'errors' => $errors,
                        'model' => $_POST
                    ]);
            } else {
                User::addUser($_POST['email'], $_POST['login'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['birthDate'], $_POST['gender']);
                return $this->renderView('register-success');
            }

        } else {
            $genders = Genders::getAllGenders();
            return $this->render(null,
                ['genders' => $genders],
            );
        }
    }

    public function loginAction()
    {
        if (User::isUserAuthenticated())
            $this->redirect('/');

        if (Core::getInstance()->requestMethod == 'POST') {
            $user = User::getUserByLoginAndPassword($_POST['login'], $_POST['password']);

            $error = null;
            if (empty($user)) {
                $error = 'Неправильний логін або пароль!';
            } else {
                User::authenticatedUser($user);
                $this->redirect('/');
            }

            return $this->render(null,
                [
                    'error' => $error,
                    'model' => $_POST
                ]);
        }

        return $this->render();
    }

    public function logoutAction()
    {
        User::logoutUser();
        $this->redirect('/');
    }
}