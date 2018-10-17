<?php

use Domain\Entity\EmployeeLocation;
use Domain\Repository\IEmployeeLocationRepository;
use Infrastructure\CommandHandlers\EmployeeLocationCommandHandler;
use PHPUnit\Framework\TestCase;


class EmployeeLocationCommandHandlerTest extends TestCase
{

    public function test_create_whenEmployeeLocationObjectIsGiven_shouldCreateLocationDataForEmployee(): void
    {
        $employeeLocationStub = new EmployeeLocationRepositoryStub();
        $employeeLocationCommandHandler   = new EmployeeLocationCommandHandler($employeeLocationStub);
        $employeeLocationCommandHandler->create($this->getMockEmployeeLocations());
        $this->assertTrue($employeeLocationStub->__get("createSuccessFull"));
    }


    public function test_deleteLocations_whenEmployeeIdIsGiven_shouldDeleteAllLocationDataForEmployee(): void
    {
        $employeeLocationStub = new EmployeeLocationRepositoryStub();
        $employeeLocationCommandHandler   = new EmployeeLocationCommandHandler($employeeLocationStub);
        $employeeLocationCommandHandler->deleteLocations(1);
        $this->assertTrue($employeeLocationStub->__get("deleteSuccessFull"));
    }

    public function test_updateLocations_whenEmployeeIdIsGiven_shouldUpdateLocationDataForEmployee(): void
    {
        $employeeLocationStub = new EmployeeLocationRepositoryStub();
        $employeeLocationCommandHandler   = new EmployeeLocationCommandHandler($employeeLocationStub);
        $locations = array(1,2,3);
        $employeeLocationCommandHandler->updateLocations(1,$locations);
        $this->assertTrue($employeeLocationStub->__get("deleteSuccessFull"));
        $this->assertTrue($employeeLocationStub->__get("createSuccessFull"));
    }

    private function getMockEmployeeLocations()
    {
        $mockEmployeeLocation = new EmployeeLocation();
        $mockEmployeeLocation->employeeId = 1;
        $mockEmployeeLocation->locationId = 1;
        return $mockEmployeeLocation;
    }
}


class EmployeeLocationRepositoryStub implements IEmployeeLocationRepository
{
    private $createSuccessFull = false;
    private $deleteSuccessFull = false;

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

    public function create(EmployeeLocation $employeeLocation)
    {
        if($employeeLocation->locationId == 1 && $employeeLocation->employeeId == 1){
            $this->createSuccessFull = true;
        }
    }

    public function read($employeeId)
    {
        // TODO: Implement read() method.
    }

    public function readByName($employeeName)
    {
        // TODO: Implement readByName() method.
    }

    public function delete($employeeId)
    {
        if($employeeId == 1){
            $this->deleteSuccessFull = true;
        }
    }
}