<?php

class Employee{
    protected $id;
    public $name;
    public $secondName;
    public $gender;
    public $department;

    const GENDER_MALE='m';
    const GENDER_FEMALE='f';
    
    public function __construct($name,$secondName,$gender,$department=NULL){
        $this->name=$name;
        $this->secondName=$secondName;
        $this->gender=$gender;
        /**
         * департамент - необязательный параметр. На случай форс-мажорных случаев. Пример: Отдел расформирован, а куда переопределить сотрудника - еще не решили 
         */
        $this->department=$department; //
    }
    
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id=$id;
    }
}