<?php

namespace Controllers;

use Domain\Entity\EmployeeLocation;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class EmployeeLocationController
{
    protected $employeeLocationQuery;
    protected $addEmployeeLocationCommand;
    protected $deleteLocationsForEmployeeCommand;
    protected $updateLocationsForEmployeeCommand;

    public function __construct(ContainerInterface $container)
    {
        $this->employeeLocationQuery = $container->get('IEmployeeLocationQuery');
        $this->addEmployeeLocationCommand = $container->get('IAddEmployeeLocationCommand');
        $this->deleteLocationsForEmployeeCommand = $container->get('IDeleteLocationsForEmployeeCommand');
        $this->updateLocationsForEmployeeCommand = $container->get('IUpdateLocationsForEmployeeCommand');
    }


    public function getEmployeeLocation(Request $request, Response $response, array $args = null) :Response
    {
        $id= (int)$args['id'];
        $employeeLocations = $this->employeeLocationQuery->getById($id);
        return $response->withJson($employeeLocations);
    }

    public function getEmployeeLocationByName(Request $request, Response $response, array $args = null) :Response
    {
        $name= $args['name'];
        $employeeLocations = $this->employeeLocationQuery->getByName($name);
        return $response->withJson($employeeLocations);
    }

    public function createEmployeeLocations(Request $request, Response $response, array $args = null) :Response
    {
        $requestList = json_decode($request->getBody());

        foreach ($requestList->employeelocations as $requestObj)
        {
            $employeeLocation = new EmployeeLocation();
            $employeeLocation->employeeId = $requestObj->employeeId;
            $employeeLocation->locationId= $requestObj->locationId;
            $this->addEmployeeLocationCommand->create($employeeLocation);
        }
        return $response;
    }

    public function updateLocationsForEmployee(Request $request, Response $response, array $args = null) :Response
    {
        $id= (int)$args['id'];
        $requestObj = json_decode($request->getBody());
        $this->updateLocationsForEmployeeCommand->updateLocations($id,$requestObj->locations);
        return $response;
    }

    public function deleteLocationsForEmployee(Request $request, Response $response, array $args = null) :Response
    {
        $id= (int)$args['id'];
        $this->deleteLocationsForEmployeeCommand->deleteLocations($id);
        return $response;
    }
}