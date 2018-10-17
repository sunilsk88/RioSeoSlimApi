<?php

namespace Controllers;

use Application\Dto\EmployeeDto;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;


class EmployeeController
{
    protected $employeeQuery;
    protected $addEmployeeCommand;


    public function __construct(ContainerInterface $container)
    {
        $this->employeeQuery = $container->get('IEmployeeQuery');
        $this->addEmployeeCommand = $container->get('IAddEmployeeCommand');
    }


    public function getEmployee(Request $request, Response $response, array $args = null) :Response
    {
        $id= (int)$args['id'];
        $emp = $this->employeeQuery->execute($id);
        $response->getBody()->write("Get Employee aaaaa!  -- " .$emp->lastName);
        return $response;
    }


    public function createEmployee(Request $request, Response $response, array $args = null) :Response
    {
        $requestObj = json_decode($request->getBody());
        $employeeDto = new EmployeeDto();
        $employeeDto->lastName = $requestObj->lastName;
        $employeeDto->firstName = $requestObj->firstName;
        $employeeDto->email = $requestObj->email;
        $employeeDto->titleId = $requestObj->titleId;
        $this->addEmployeeCommand->execute($employeeDto);
        return $response;
    }

}