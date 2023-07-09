<?php
safe_require('utils/SingleConnection.php');

abstract class BaseRepo
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new SingleConnection();
    }

    public function executeQuery($queryText, $paramDict = null)
    {
        $command = $this->connection
            ->getConnection()
            ->prepare($queryText);

        if (!is_null($paramDict)) {
            $paramTypes = '';
            foreach ($paramDict as $param => $type) {
                $paramTypes .= $type;
                $aggregatedParams[] = $param;
            }

            if (!is_null($aggregatedParams) && count($aggregatedParams) > 0) {
                $command->bind_param($paramTypes, ...$aggregatedParams);
            }
        }

        $command
            ->execute();

        return $command
            ->get_result();
    }

    abstract function getEntity($id);

    abstract function getAll();

    abstract function saveEntity($entity);

    abstract function updateEntity($entity);
}