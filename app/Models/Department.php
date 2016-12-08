<?php

class Department{
    protected $id;
    public $name;
    public $room;

    public function __construct($name,$room){
        $this->name=$name;
        $this->room=$room;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id=$id;
    }
}