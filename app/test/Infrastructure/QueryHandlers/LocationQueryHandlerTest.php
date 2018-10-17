<?php


use PHPUnit\Framework\TestCase;
use \Infrastructure\QueryHandlers\LocationQueryHandler;
use Domain\Entity\Location;

class LocationQueryHandlerTest extends TestCase
{
    public function test_getById_whenLocationIsPassed_shouldReturnLocationData(): void
    {
        $mockRepo = $this->getMockBuilder("Domain\Repository\ILocationRepository")
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $mockLocation = $this->getMockLocations();
        $mockRepo->method('read')
            ->willReturn($mockLocation);


        $expectedLocation = new \Domain\Entity\Location();
        $expectedLocation->id = 1;
        $expectedLocation->address = "address";

        $sut = new LocationQueryHandler($mockRepo);
        $this->assertEquals($expectedLocation,$sut->getById(1));
    }

    private function getMockLocations()
    {
        $mockLocation = new Location();
        $mockLocation->id = 1;
        $mockLocation->address = "address";
        return $mockLocation;
    }
}