<?php
safe_require('entities/BaseEntity.php');

class TestEntity extends BaseEntity
{
    public $name;

    public function __toString() {
        return "Test id=$this->id, name=$this->name";
    }
}