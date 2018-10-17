<?php

namespace Application\Commands;


interface IDeleteLocationsForEmployeeCommand
{
    public function deleteLocations($employeeId);
}