<?php
safe_require('repositories/BaseRepo.php');
safe_require('entities/TestEntity.php');

class TestRepo extends BaseRepo
{
    /**
     * @param $id
     * @return TestEntity
     */
    public function getEntity($id)
    {
        $sql = <<<SQL
            SELECT
                id,
                name
            FROM test
            WHERE id = $id
SQL;
        $entity = new TestEntity();
        foreach ($this->executeQuery($sql) as $record) {
            $entity->id = $record['id'];
            $entity->name = $record['name'];
        }
        return $entity;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $sql = <<<SQL
            SELECT
                id,
                name
            FROM test
SQL;

        foreach ($this->executeQuery($sql) as $record) {
            $entity = new TestEntity();
            $entity->id = $record['id'];
            $entity->name = $record['name'];
            $entities[] = $entity;

        }
        return $entities;
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function saveEntity($entity)
    {
        $sql = <<<SQL
            INSERT INTO test (name)
            VALUES (?)
SQL;

        $this->executeQuery($sql, array($entity->name => 's'));
        foreach ($this->executeQuery('SELECT LAST_INSERT_ID() as lastid') as $record) {
            $entity->id = $record['lastid'];
        }
        return $entity;
    }

    /**
     * @param $entity
     * @return TestEntity
     */
    public function updateEntity($entity)
    {
        $sql = <<<SQL
            UPDATE test SET name = ? WHERE (id = ?);
SQL;

        $this->executeQuery($sql, array($entity->name => 's', $entity->id => 'i'));
        $entity = $this->getEntity($entity->id);
        return $entity;
    }


    /**
     * @param $entity
     * @return void
     */
    public function deleteEntity($entity)
    {
        $sql = <<<SQL
            DELETE FROM test WHERE (id = ?)
SQL;

        $this->executeQuery($sql, array($entity->id => 'i'));
    }

}