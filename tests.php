<?php
### Тесты ###

//Создание нового сотрудника
function newEmployes($employesTable)
{
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
function newDepartments($departmentsTable)
{
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
function setDepartment($employesTable)
{
    $employesTable->setDepartment(1,2); //установить департамент_ид=2, тому у кого ид=1
    $employesTable->setDepartment(2,2);
    $employesTable->setDepartment(3,2);
    $employesTable->setDepartment(4,1);
    $employesTable->setDepartment(5,1);
}


//Удаление сотрудника;
function delEmployee($employesTable)
{
    echo "Удаляем сотрудника с id 3:";
    var_dump($employesTable->delete(3));
}


//Удаление отдела;
function delDepartment($departmentsTable)
{
    echo "Удаляем отдел по id 3:";
    var_dump($departmentsTable->delete(3));
}


//Выбор всех отделов с кол-м сотрудников в них.
function showDepartmentMembersCount($departmentsTable)
{
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
function showDepartmentMembers($departmentsTable)
{
    echo "В отделе с id 4 работают:";
    var_dump($departmentsTable->getEmployeeList(4));
}


### Запускаем ###
newEmployes($employesTable);
newDepartments($departmentsTable);
setDepartment($employesTable);
delEmployee($employesTable);
delDepartment($departmentsTable);
showDepartmentMembersCount($departmentsTable);
showDepartmentMembers($departmentsTable);