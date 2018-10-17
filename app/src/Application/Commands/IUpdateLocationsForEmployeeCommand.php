<?php


namespace Application\Commands;


interface IUpdateLocationsForEmployeeCommand
{
    public function updateLocations($employeeId, $locations);
}