<?php


use Domain\Entity\EmployeeLocation;
use PHPUnit\Framework\TestCase;
use Infrastructure\QueryHandlers\EmployeeLocationQueryHandler;


final class EmployeeLocationQueryHandlerTest extends TestCase
{
    public function test_getById_whenEmployeeNameIsPassed_shouldReturnEmployeeAndLocationData(): void
    {
        $mockRepo = $this->getMockBuilder("Domain\Repository\IEmployeeLocationRepository")
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $mockEmployeeLocations = $this->getMockEmployeeLocations();
        $mockRepo->method('read')
            ->willReturn($mockEmployeeLocations);

        $expectedEmployeeLocations = array();
        $employeeLocation = new EmployeeLocation();
        $employeeLocation->employeeId = 1;
        $employeeLocation->locationId= 1;
        array_push($expectedEmployeeLocations,$employeeLocation);

        $sut = new EmployeeLocationQueryHandler($mockRepo);
        $this->assertEquals($expectedEmployeeLocations,$sut->getById(1)
        );
    }

    public function test_getByName_whenEmployeeNameIsPassed_shouldReturnEmployeeAndLocationData(): void
    {
        $mockRepo = $this->getMockBuilder("Domain\Repository\IEmployeeLocationRepository")
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $mockEmployeeLocations = $this->getMockEmployeeLocations();
        $mockRepo->method('readByName')
            ->willReturn($mockEmployeeLocations);

        $expectedEmployeeLocations = array();
        $employeeLocation = new EmployeeLocation();
        $employeeLocation->employeeId = 1;
        $employeeLocation->locationId= 1;
        array_push($expectedEmployeeLocations,$employeeLocation);

        $sut = new EmployeeLocationQueryHandler($mockRepo);
        $this->assertEquals($expectedEmployeeLocations,$sut->getByName("a")
        );
    }

    private function getMockEmployeeLocations(){
        $mockEmployeeLocations = array();
        array_push($mockEmployeeLocations,array("employeeId"=>"1", "locationId"=>"1"));
        return $mockEmployeeLocations;
    }

}