<?php

namespace Application\Commands;


interface IAddEmployeeCommand
{
    public function execute($employee);
}