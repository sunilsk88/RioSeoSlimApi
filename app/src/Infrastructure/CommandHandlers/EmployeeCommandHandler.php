<?php


namespace Infrastructure\CommandHandlers;


use Application\Commands\IAddEmployeeCommand;

class EmployeeCommandHandler implements IAddEmployeeCommand
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function execute($employee)
    {
        $statement = $this->pdo->prepare("Insert into Employee (firstName,lastName,email,titleId) values (:firstName,:lastName,:email,:titleId)");
        $statement->bindParam(":firstName",$employee->firstName);
        $statement->bindParam(":lastName",$employee->lastName);
        $statement->bindParam(":email",$employee->email);
        $statement->bindParam(":titleId",$employee->titleId);
        $statement->execute();
    }
}
