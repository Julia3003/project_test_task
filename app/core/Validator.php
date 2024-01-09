<?php

namespace core;

use DateTime;

class Validator
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') == $date;
    }
    
}
