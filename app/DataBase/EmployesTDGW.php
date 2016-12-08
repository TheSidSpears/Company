<?php

class EmployesTDGW{
    protected $db; //Объект PDO

    public function __construct(\PDO $connection){
        $this->db=$connection;
    }

    public function add(Employee $employee){

        $SqlString="INSERT INTO `employes`
                    (`name`,`second_name`,`gender`,`department`)
                    VALUES
                    (:name,:second_name,:gender,:department)";
        
        $stmt = $this->db->prepare($SqlString);

        $stmt->bindValue(':name', $employee->name, \PDO::PARAM_STR);
        $stmt->bindValue(':second_name', $employee->secondName, \PDO::PARAM_STR);
        $stmt->bindValue(':gender', $employee->gender, \PDO::PARAM_STR);
        $stmt->bindValue(':department', $employee->department, \PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function delete(int $id){
        $SqlString="DELETE FROM `employes`
        WHERE `id`=:id";

        $stmt = $this->db->prepare($SqlString);

        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        return $stmt->execute();  
    }

    public function setDepartment($employeeId,$departmentId){
        $SqlString="UPDATE `employes`
        SET `department`=:departmentId
        WHERE `id`=:employeeId";

        $stmt = $this->db->prepare($SqlString);

        $stmt->bindValue(':employeeId', $employeeId, \PDO::PARAM_INT);
        $stmt->bindValue(':departmentId', $departmentId, \PDO::PARAM_INT);

        return $stmt->execute();
    }
}