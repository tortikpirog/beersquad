<?php

class UserRepo extends BaseRepo
{

    function getEntity($id)
    {
        $sql = <<<SQL
            SELECT
                id,
                first_name,
                surname,
                login,
                password,
                salt
            FROM users
            WHERE id = $id
SQL;
        $entity = new UserEntity();
        foreach ($this->executeQuery($sql) as $record) {
            $entity->id = $record['id'];
            $entity->firstName = $record['first_name'];
            $entity->surname = $record['surname'];
            $entity->login = $record['login'];
            $entity->password = $record['password'];
            $entity->salt = $record['salt'];
        }
        return $entity;
    }

    function getAll()
    {
        $sql = <<<SQL
            SELECT
                id,
                first_name,
                surname,
                login,
                password,
                salt
            FROM users
SQL;

        foreach ($this->executeQuery($sql) as $record) {
            $entity = new UserEntity();
            $entity->id = $record['id'];
            $entity->firstName = $record['first_name'];
            $entity->surname = $record['surname'];
            $entity->login = $record['login'];
            $entity->password = $record['password'];
            $entity->salt = $record['salt'];
            $entities[] = $entity;

        }
        return $entities;
    }

    function saveEntity($entity)
    {
        $sql = <<<SQL
            INSERT INTO users (first_name,
                surname,
                login,
                password,
                salt)
            VALUES (?,?,?,?,?)
SQL;

        $this->executeQuery($sql, array($entity->first_name => 's',
            $entity->surname => 's',
            $entity->login => 's',
            $entity->password => 's',
            $entity->salt => 's'));
        foreach ($this->executeQuery('SELECT LAST_INSERT_ID() as lastid') as $record) {
            $entity->id = $record['lastid'];
        }
        return $entity;
    }

    function updateEntity($entity)
    {
        $sql = <<<SQL
            UPDATE users SET (first_name,
                surname,
                login,
                password,
                salt) = (?,?,?,?,?) WHERE (id = ?);
SQL;

        $this->executeQuery($sql, array($entity->first_name => 's',
            $entity->surname => 's',
            $entity->login => 's',
            $entity->password => 's',
            $entity->salt => 's',
            $entity->id => 'i'));
        $entity = $this->getEntity($entity->id);
        return $entity;
    }

    function deleteEntity($entity)
    {
        $sql = <<<SQL
            DELETE FROM users WHERE (id = ?)
SQL;

        $this->executeQuery($sql, array($entity->id => 'i'));
    }

    function hashPassword($password, $salt) {
       return md5($password.$salt);
    }
}