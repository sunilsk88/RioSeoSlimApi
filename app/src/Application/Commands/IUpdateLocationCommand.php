<?php

namespace Application\Commands;


use Application\Dto\LocationDto;

interface IUpdateLocationCommand
{
    public function update($id, LocationDto $location);
}