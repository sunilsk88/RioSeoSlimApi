<?php

use Application\Dto\LocationDto;
use Application\Queries\ILocationQuery;
use Domain\Entity\Location;
use Domain\Repository\ILocationRepository;
use Infrastructure\CommandHandlers\LocationCommandHandler;
use PHPUnit\Framework\TestCase;


class LocationCommandHandlerTest extends TestCase
{

    public function test_create_whenLocationObjectIsGiven_shouldCreateLocationData(): void
    {
        $locationStub = new LocationRepositoryStub();
        $locationCommandHandler   = new LocationCommandHandler($locationStub, new LocationQueryStub());
        $locationCommandHandler->create($this->getMockLocations());
        $this->assertTrue($locationStub->__get("createSuccessFull"));
    }

    public function test_update_whenLocationObjectIsGiven_shouldUpdateTheExistingLocationData(): void
    {
        $locationStub = new LocationRepositoryStub();
        $locationCommandHandler   = new LocationCommandHandler($locationStub, new LocationQueryStub());
        $locationCommandHandler->update(1,$this->getMockLocations());
        $this->assertTrue($locationStub->__get("updateSuccessFull"));
    }



    private function getMockLocations()
    {
        $mockLocationDto = new LocationDto();
        $mockLocationDto->locationName = "mockLocationName";
        return $mockLocationDto;
    }

}

class LocationRepositoryStub implements ILocationRepository
{
    private $createSuccessFull = false;
    private $updateSuccessFull = false;

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


    public function create(LocationDto $location)
    {
        if($location->locationName == "mockLocationName")
        {
            $this->createSuccessFull = true;
        }

    }

    public function read($id)
    {
        // TODO: Implement read() method.
    }

    public function update($location)
    {
        if($location->locationName == "mockLocationName")
        {
            $this->updateSuccessFull = true;
        }

    }
}

class LocationQueryStub implements ILocationQuery
{

    public function getById($id)
    {
        $mockLocationData = new Location();
        $mockLocationData->locationName ="entitylocationName";
        return $mockLocationData;
    }
}