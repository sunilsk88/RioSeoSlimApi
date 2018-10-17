<?php

namespace Domain\Repository;


use Domain\Entity\EmployeeLocation;

interface IEmployeeLocationRepository
{
    public function create(EmployeeLocation $employeeLocation);
    public function read($employeeId);
    public function readByName($employeeName);
    public function delete($employeeId);
}