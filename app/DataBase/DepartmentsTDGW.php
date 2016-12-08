<?php

class DepartmentsTDGW{
    protected $db; //Объект PDO

    function __construct(\PDO $connection){
        $this->db=$connection;
    }

    public function add(Department $department){

        $SqlString="INSERT INTO `departments`
                    (`name`,`room`)
                    VALUES
                    (:name,:room)";
        
        $stmt = $this->db->prepare($SqlString);

        $stmt->bindValue(':name', $department->name, \PDO::PARAM_STR);
        $stmt->bindValue(':room', $department->room, \PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    public function delete(int $id){
        $SqlString="DELETE FROM `departments`
        WHERE `id`=:id";

        $stmt = $this->db->prepare($SqlString);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    //Ф-ия не по ТЗ
    public function getDepartments(){
        $SqlString="SELECT * FROM `departments`";
        $stmt = $this->db->prepare($SqlString);
        $stmt->execute();


        $departmentsRows=$stmt->fetchAll(\PDO::FETCH_ASSOC);
        //Подготавливаем массив
        $departments=array();
        foreach($departmentsRows as $departmentRow){
            $department=new Department($departmentRow['name'],$departmentRow['room']);
            $department->setId($departmentRow['id']);
            $departments[]=$department;
        }
        return $departments;
    }

    /*
    тут вроде неувязочка
    TDGW к таблице departments относится, а ф-ия обращается к Employess
    Это неверно из определнения TableDataGateway
     */
    public function getEmployeeCount(int $id){
        $SqlString="SELECT COUNT(*) FROM `employes`
        WHERE `department`=:id";

        $stmt = $this->db->prepare($SqlString);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getEmployeeList(int $id){
        $SqlString="SELECT * FROM `employes`
        WHERE `department`=:id";

        $stmt = $this->db->prepare($SqlString);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();


        $employesRows=$stmt->fetchAll(\PDO::FETCH_ASSOC);
        //Подготавливаем массив
        $employes=array();
        foreach($employesRows as $employeeRow){
            $employee=new Employee(
                $employeeRow['name'],
                $employeeRow['second_name'],
                $employeeRow['gender'],
                $employeeRow['department']);

            $employee->setId($employeeRow['id']);
            $employes[]=$employee;
        }
        return $employes;
    }
}