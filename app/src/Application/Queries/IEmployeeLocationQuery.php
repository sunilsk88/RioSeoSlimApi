<?php

namespace Application\Queries;


interface IEmployeeLocationQuery
{
    public function getById($employeeId);
    public function getByName($employeeName);

}