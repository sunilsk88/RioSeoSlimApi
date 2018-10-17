<?php

namespace Infrastructure\Repositories;


use Domain\Entity\EmployeeLocation;
use Domain\Repository\IEmployeeLocationRepository;

class EmployeeLocationRepository implements IEmployeeLocationRepository
{

    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(EmployeeLocation $employeeLocation)
    {
        $statement = $this->pdo->prepare("Insert into EmployeeLocation (employeeId,locationId) values (:employeeId,:locationId)");
        $statement->bindParam(":employeeId",$employeeLocation->employeeId);
        $statement->bindParam(":locationId",$employeeLocation->locationId);
        $statement->execute();
    }

    public function read($employeeId)
    {
        $employeeLocationsDataList  = $this->pdo-> query('SELECT * FROM EmployeeLocation where employeeId = '.$employeeId)->fetchAll();
        return $employeeLocationsDataList;
    }

    public function readByName($employeeName)
    {
        $statement  = $this->pdo->prepare("Select * from EmployeeLocation el inner join Employee e on e.id = el.employeeId WHERE e.lastName = :lastName");
        $statement->bindParam(":lastName",$employeeName);
        $statement->execute();
        return $statement->fetchAll();
    }


    public function delete($employeeId)
    {
        $statement = $this->pdo->prepare("Delete from EmployeeLocation where employeeId = :employeeId");
        $statement->bindParam(":employeeId",$employeeId);
        $statement->execute();
    }
}