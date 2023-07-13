<?php

class TestService
{
    private $repo;

    public function __construct()
    {
        $this->repo = new TestRepo();
    }

    public function test($id)
    {
        return $this->repo->getEntity($id);
    }

    public function create($name){
        $entity = new TestEntity();
        $entity->name = $name;
        $this->repo->saveEntity($entity);

    }

    public function showAll(){
        return $this->repo->getAll();
    }
}