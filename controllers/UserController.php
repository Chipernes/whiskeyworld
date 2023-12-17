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
        $currentAuthenticatedUser = User::getCurrentAuthenticatedUser();
        $genders = Genders::getAllGenders();
        return $this->render(null,
            [
                'users' => $users,
                'currentAuthenticatedUser' => $currentAuthenticatedUser,
                'genders' => $genders,
            ]);
    }

    public function cabinetAction()
    {
        $currentUser = User::getCurrentAuthenticatedUser();
        $genders = Genders::getAllGenders();
        return $this->render(null,
            [
                'currentUser' => $currentUser,
                'genders' => $genders,
            ]
        );
    }

    public function editAction()
    {
        $currentUser = User::getCurrentAuthenticatedUser();
        $genders = Genders::getAllGenders();

        if (Core::getInstance()->requestMethod == 'POST') {
            $errors = [];

            if (User::isUserExists('Email', $_POST['email']))
                $errors['email'] = 'Така електронна пошта вже зайнята';

            if (User::isUserExists('Login', $_POST['login']))
                $errors['login'] = 'Такий логін вже зайнятий';

            if (empty($errors)) {
                $valuesArray = [
                    'Email' => $_POST['email'],
                    'Login' => $_POST['login'],
                    'Password' => md5($_POST['passwordNew']),
                    'Firstname' => $_POST['firstname'],
                    'Lastname' => $_POST['lastname'],
                    'BirthDate' => $_POST['birthDate'],
                    'GenderId' => $_POST['genderId'],
                ];

                foreach ($valuesArray as $item => $value) {
                    if ($value == '')
                        $valuesArray[$item] = null;
                }

                if (md5($_POST['passwordNew']) == $currentUser['Password']) {
                    User::updateUser($currentUser['UserId'], $valuesArray);
                }

                $this->redirect('/user/cabinet');
            } else {
                return $this->render(null,
                    [
                        'errors' => $errors,
                        'model' => $currentUser,
                        'genders' => $genders,
                    ]);
            }
        }

        return $this->render(null,
            [
                'genders' => $genders,
                'model' => $currentUser,
            ]
        );
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
                User::addUser($_POST['email'], $_POST['login'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['birthDate'], $_POST['genderId']);
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

    public function setAdminAction()
    {
        $id = intval($_GET['user']);
        User::setAdminRights($id);
        $this->redirect('/user');
    }

    public function deleteAdminAction()
    {
        $id = intval($_GET['user']);
        User::deleteAdminRights($id);
        $this->redirect('/user');
    }
}