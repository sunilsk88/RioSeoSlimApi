<?php

namespace Application\Commands;


use Domain\Entity\EmployeeLocation;

interface IAddEmployeeLocationCommand
{
    public function create(EmployeeLocation $employeeLocation);
}