<?php

namespace Application\Commands;

use Application\Dto\LocationDto;

interface IAddLocationCommand
{
    public function create(LocationDto $location);
}