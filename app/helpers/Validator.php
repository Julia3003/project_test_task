<?php


namespace helpers;


class Validator
{
    public static function equalPass($pass, $conf_pass)
    {
        if ($pass !== $conf_pass) {
            $errors[] = "Password and confirm password does not match";
            Session::setErrors($errors);
            return false;
        }
        return true;
    }

    public static function checkListInput(array $List)
    {
        $errors = [];
        foreach ($List as $item) {
            if (self::isValid($item) !== true) {
                $errors[] = self::isValid($item);
            }
        }
        if (count($errors) > 0) {
            Session::setErrors($errors);
        } else {
            return true;
        }
    }

    static public function isValid($value, $name = 'field', $length = 3)
    {

//        var_dump($value);
        if ($value === '' || !isset($value)) {
            return "{$name} can`t be empty";
        }
        $value = trim($value);
        if ($value === 0) {
            return "{$name} can`t be zero";
        }
        if (strlen($value) < $length) {
            return "{$name} can`t be less {$length} characters";
        }
        return true;
    }
}