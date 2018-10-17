<?php


namespace Infrastructure\QueryHandlers;


use Application\Queries\IEmployeeLocationQuery;
use Domain\Entity\EmployeeLocation;
use Domain\Repository\IEmployeeLocationRepository;

class EmployeeLocationQueryHandler implements IEmployeeLocationQuery
{

    protected $employeeLocationRepository;

    public function __construct(IEmployeeLocationRepository $employeeLocationRepository)
    {
        $this->employeeLocationRepository = $employeeLocationRepository;
    }

    public function getById($employeeId)
    {
        $employeeLocations = array();
        $employeeLocationsDataList  = $this->employeeLocationRepository->read($employeeId);
        foreach ($employeeLocationsDataList as $employeeLocationRow){
            $employeeLocation = new EmployeeLocation();
            $employeeLocation->employeeId = $employeeLocationRow["employeeId"];
            $employeeLocation->locationId= $employeeLocationRow["locationId"];
            array_push($employeeLocations,$employeeLocation);
        }
        return $employeeLocations;
    }


    public function getByName($employeeName)
    {
        $employeeLocations = array();
        $employeeLocationsDataList  = $this->employeeLocationRepository->readByName($employeeName);
        foreach ($employeeLocationsDataList as $employeeLocationRow){
            $employeeLocation = new EmployeeLocation();
            $employeeLocation->employeeId = $employeeLocationRow["employeeId"];
            $employeeLocation->locationId = $employeeLocationRow["locationId"];
            array_push($employeeLocations,$employeeLocation);
        }
        return $employeeLocations;
    }
}