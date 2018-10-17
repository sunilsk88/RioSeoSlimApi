<?php

namespace Infrastructure\QueryHandlers;


use Application\Queries\ILocationQuery;
use Domain\Repository\ILocationRepository;

class LocationQueryHandler implements ILocationQuery
{

    protected $locationRepository;

    public function __construct(ILocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function getById($id)
    {
        return $this->locationRepository->read($id);
    }
}