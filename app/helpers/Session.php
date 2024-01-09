<?php

namespace helpers;

class Session
{
    /**
     * @param array $errors
     * @return void
     */
    static public function setErrors(array $errors)
    {
        session_start();
        $_SESSION['errors'] = $errors;
    }

    /**
     * @return array|mixed
     */
    static public function getErrors()
    {
        session_start();
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            return $errors;
        }
        return [];
    }

    /**
     * @param string $name
     * @param $value
     * @return void
     */
    static public function setValue( string $name, $value)
    {
        session_start();
        $_SESSION[$name] = $value;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    static public function getValue(string $name)
    {
        session_start();
        if (isset($_SESSION[$name])) {
            $value = $_SESSION[$name];
            unset($_SESSION[$name]);
            return $value;
        }
        return null;
    }

    /**
     * @param $keys
     * @return void
     */
    static public function delFromSession(array $keys) : void
    {
        session_start();
        foreach ($keys as $key => $value){
            if (isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
            }
        }
    }

    /**
     * @return bool
     */
    static public function isAuth(): bool
    {
        session_start();
        return !empty($_SESSION['user']);
    }

    /**
     * @return bool
     */
    static public function isAuthRoot(): bool
    {
        if (self::isAuth()) {
            $user = self::getAuthUser();
            if ($user['id'] == 1) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return array|null
     */
    static public function getAuthUser(): ?array
    {
        session_start();
        if(empty($_SESSION['user'])){
            return null;
        }
        return $_SESSION['user'];
    }
}