<?php

error_reporting(-1);
mb_internal_encoding('utf-8');


/**
 * Автозагрузчик всех классов
 */
spl_autoload_register(
    function ($className) {
        // Получаем путь к файлу из имени класса
        $folders=array('DataBase','Models');
        foreach ($folders as $folder) {
            $path=realpath(__DIR__."/app/$folder/$className.php");
            if ($path) {
                require_once $path;
            }
        }
    }
);

/**
 * Подключение к БД
 */
$config['host']='localhost';
$config['dbname']='company';
$config['user']='root';
$config['password']='';

$connect_str = 'mysql'
.':host='. $config['host']
.';dbname='.$config['dbname'];

$db=new PDO($connect_str,
    $config['user'],
    $config['password']
            ,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8, sql_mode='STRICT_ALL_TABLES'")
            );
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//"Карты" таблиц
$employesTable=new EmployesTDGW($db);
$departmentsTable=new DepartmentsTDGW($db);




### Тесты ###

//Создание нового сотрудника
function newEmployes(){
    $empls[0]=new Employee('Dane','Larson',Employee::GENDER_MALE);
    $empls[1]=new Employee('Kate','Morrow',Employee::GENDER_FEMALE);
    $empls[2]=new Employee('Al','Capone',Employee::GENDER_MALE);
    $empls[3]=new Employee('John','Mayer',Employee::GENDER_MALE);
    $empls[4]=new Employee('Alex','Guilber',Employee::GENDER_MALE);

    print_r($empls);


    foreach ($empls as $employee){
        echo "Добавляем сотрудника ".$employee->name." в таблицу: ";
        var_dump($employesTable->add($employee));
    }
}


//Создание нового отдела
function newDepartments(){
    $deps[0]=new Department('PR','k303p');
    $deps[1]=new Department('HR','k304p');
    $deps[2]=new Department('IT','k305p');

    print_r($deps);


    foreach ($deps as $department){
        echo "Добавляем департамент ".$department->name." в таблицу: ";
        var_dump($departmentsTable->add($department));
    }
}


//Привязка сотрудника к новому отделу;
function setDepartment(){
    $employesTable->setDepartment(1,2); //установить департамент_ид=2, тому у кого ид=1
    $employesTable->setDepartment(2,2);
    $employesTable->setDepartment(3,2);
    $employesTable->setDepartment(4,4);
    $employesTable->setDepartment(5,4);
}


//Удаление сотрудника;
function delEmployee(){
    echo "Удаляем сотрудника с id 3:";
    var_dump($employesTable->delete(3));
}


//Удаление отдела;
function delDepartment(){
    echo "Удаляем отдел по id 3:";
    var_dump($departmentsTable->delete(3));
}


//Выбор всех отделов с кол-м сотрудников в них.
function showDepartmentMembersCount(){
    $depsFromDB=$departmentsTable->getDepartments(); //возвращает массив объектов Department array(id,name,room)

    echo "Все департаменты, что есть в таблице: ";
    var_dump($depsFromDB);

    foreach ($depsFromDB as $department){
        echo "В отделе ".$department->name." ";
        echo $departmentsTable->getEmployeeCount($department->getId());
        echo " сотрудников\n";
    }
}


//Показать всех сотрудников какого-либо отдела
function showDepartmentMembers(){
    echo "В отделе с id 4 работают:";
    var_dump($departmentsTable->getEmployeeList(4));
}


### Запускаем ###
//newEmployes();
//newDepartments();
//setDepartment();
//delEmployee();
//delDepartment();
//showDepartmentMembersCount();
//showDepartmentMembers();