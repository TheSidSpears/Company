<?php
/**
 * Объект "Сотрудник"
 */
class Employee extends Model
{
    public $name;
    public $secondName;
    public $gender;
    public $department;

    const GENDER_MALE='m';
    const GENDER_FEMALE='f';
    
    public function __construct(string $name,
        string $secondName,
        string $gender,
        int $department=NULL)
    {
        $this->name=$name;
        $this->secondName=$secondName;
        $this->gender=$gender;
        if (in_array($gender, array(self::GENDER_MALE,self::GENDER_FEMALE))) {
            $this->gender=$gender;
        }
        /**
         * отдел - необязательный параметр. На случай форс-мажорных случаев. Пример: Отдел расформирован, а куда переопределить сотрудника - еще не решили 
         */
        $this->department=$department;
    }
}