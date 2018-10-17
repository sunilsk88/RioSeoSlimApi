<?php

namespace Infrastructure\CommandHandlers;


use Application\Commands\IAddLocationCommand;
use Application\Commands\IUpdateLocationCommand;
use Application\Dto\LocationDto;
use Application\Queries\ILocationQuery;
use Domain\Repository\ILocationRepository;
use PDO;

class LocationCommandHandler implements IAddLocationCommand, IUpdateLocationCommand
{
    protected $locationRepository;
    protected $locationQuery;

    public function __construct(ILocationRepository $locationRepository, ILocationQuery $locationQuery)
    {
        $this->locationRepository = $locationRepository;
        $this->locationQuery = $locationQuery;
    }


    public function create(LocationDto $location)
    {
        $this->locationRepository->create($location);
    }


    public function update($id, LocationDto $location)
    {
        $locationEntity = $this->locationQuery->getById($id);
        $this->updateLocationEntityWithNewValues($location, $locationEntity);
        $this->locationRepository->update($locationEntity);
    }


    public function updateLocationEntityWithNewValues(LocationDto $location, $locationEntity)
    {

        if (!is_null($location->address) && $location->address != $locationEntity->address) {
            $locationEntity->address = $location->address;
        }

        if (!is_null($location->city) && $location->city != $locationEntity->city) {
            $locationEntity->city = $location->city;
        }

        if (!is_null($location->country) && $location->country != $locationEntity->country) {
            $locationEntity->country = $location->country;
        }

        if (!is_null($location->latitude) && $location->latitude != $locationEntity->latitude) {
            $locationEntity->latitude = $location->latitude;
        }

        if (!is_null($location->locationName) && $location->locationName != $locationEntity->locationName) {
            $locationEntity->locationName = $location->locationName;
        }

        if (!is_null($location->longitude) && $location->longitude != $locationEntity->longitude) {
            $locationEntity->longitude = $location->longitude;
        }

        if (!is_null($location->phone) && $location->phone != $locationEntity->phone) {
            $locationEntity->phone = $location->phone;
        }

        if (!is_null($location->postalCode) && $location->postalCode != $locationEntity->postalCode) {
            $locationEntity->postalCode = $location->postalCode;
        }

        if (!is_null($location->state) && $location->state != $locationEntity->state) {
            $locationEntity->state = $location->state;
        }
        return $locationEntity;
    }

}