<?php

namespace core;

use mysqli;

class BaseModel
{
    protected mysqli $db;

    protected bool $connectDb;
    
    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    /**
     * Екранує спеціальні символи у рядку для використання у SQL-вираженні, використовуючи поточний набір символів з'єднання
     * @param $value
     * @return string
     */
    public function escape($value)
    {
        return $this->db->real_escape_string($value);
    }

    /**
     * повертае id останнього вставленого рядка у будьяку таблицю
     * @return int|string
     */
    public function getLastId()
    {
        return $this->db->insert_id;
    }
}