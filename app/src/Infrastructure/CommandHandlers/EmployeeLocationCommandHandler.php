<?php

namespace Infrastructure\CommandHandlers;


use Application\Commands\IAddEmployeeLocationCommand;
use Application\Commands\IAddLocationsForEmployeeCommand;
use Application\Commands\IDeleteLocationsForEmployeeCommand;
use Application\Commands\IUpdateLocationsForEmployeeCommand;
use Domain\Entity\EmployeeLocation;
use Domain\Repository\IEmployeeLocationRepository;

class EmployeeLocationCommandHandler implements IAddEmployeeLocationCommand,IDeleteLocationsForEmployeeCommand, IUpdateLocationsForEmployeeCommand
{

    protected $employeeLocationRepository;

    public function __construct(IEmployeeLocationRepository $employeeLocationRepository)
    {
        $this->employeeLocationRepository = $employeeLocationRepository;
    }

    public function create(EmployeeLocation $employeeLocation)
    {
        $this->employeeLocationRepository->create($employeeLocation);
    }

    public function deleteLocations($employeeId)
    {
        $this->employeeLocationRepository->delete($employeeId);
    }


    public function updateLocations($employeeId, $locations)
    {
        $this->employeeLocationRepository->delete($employeeId);

        foreach ($locations as $location){
            $employeeLocation = new EmployeeLocation();
            $employeeLocation->locationId = $location;
            $employeeLocation->employeeId = $employeeId;
            $this->employeeLocationRepository->create($employeeLocation);
        }
    }
}