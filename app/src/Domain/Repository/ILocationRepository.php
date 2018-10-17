<?php

namespace Domain\Repository;


use Application\Dto\LocationDto;
use Domain\Entity\Location;

interface ILocationRepository
{
    public function create(LocationDto $location);
    public function read($id);
    public function update($location);
}