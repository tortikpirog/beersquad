<?php

class SingleConnection
{
    private $connection;

    /**
     * Получить объект соединения с БД
     * @return mysqli
     */
    public function getConnection() {
        if (is_null($this->connection)) {
            $this->connection = new mysqli("localhost:3306", "root", "mysql", 'test');
        }
       return $this->connection;
    }
}