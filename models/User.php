<?php

namespace models;

use core\Core;
use core\Utils;

class User
{
    protected static $tableName = 'Users';

    public static function selectUser($fieldsList = '*', $conditionArray = null)
    {
        return
            Core::getInstance()->db->select(
                self::$tableName,
                $fieldsList,
                $conditionArray,
            );
    }

    public static function addUser($email, $login, $password, $firstname, $lastname, $birthdate = null, $gender = null)
    {
        Core::getInstance()->db->insert(
            self::$tableName,
            [
                'Email' => $email,
                'Login' => $login,
                'Password' => self::hashPassword($password),
                'Firstname' => $firstname,
                'Lastname' => $lastname,
                'BirthDate' => $birthdate,
                'Gender' => $gender
            ]
        );
    }

    public static function hashPassword($password): string
    {
        return md5($password);
    }

    public static function updateUser($id, $updatesArray)
    {
        $updatesArray = Utils::filterArray($updatesArray, ['Firstname', 'Lastname']);
        Core::getInstance()->db->update(
            self::$tableName,
            $updatesArray,
            ['UserId' => $id]
        );
    }

    public static function deleteUser($conditionArray)
    {
        Core::getInstance()->db->delete(
            self::$tableName,
            $conditionArray
        );
    }

    public static function isUserExists($field, $value): bool
    {
        $user = Core::getInstance()->db->select(self::$tableName, '*', [$field => $value]);

        return !empty($user);
    }

    public static function verifyUser($login, $password): bool
    {
        $user = Core::getInstance()->db->select(self::$tableName, '*',
            [
                'Login' => $login,
                'Password' => $password,
            ]);

        return !empty($user);
    }

    public static function getUserByLoginAndPassword($login, $password)
    {
        $user = Core::getInstance()->db->select(self::$tableName, '*',
            [
                'Login' => $login,
                'Password' => self::hashPassword($password),
            ]);

        if (!empty($user))
            return $user[0];

        return null;
    }

    public static function authenticatedUser($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function logoutUser()
    {
        unset($_SESSION['user']);
        Cart::resetCart();
    }

    public static function isUserAuthenticated(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function getCurrentAuthenticatedUser()
    {
        return $_SESSION['user'];
    }

    public static function isAdmin(): bool
    {
        $user = self::getCurrentAuthenticatedUser();
        return $user['AccessLevel'] == 10;
    }
}