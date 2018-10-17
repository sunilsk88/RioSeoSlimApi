<?php


namespace Infrastructure\QueryHandlers;


use Application\Queries\IEmployeeQuery;


class EmployeeQueryHandler implements IEmployeeQuery
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function execute($id)
    {
        $employee  = $this->pdo-> query('SELECT * FROM Employee where id = '.$id)->fetchObject();
        return $employee;
    }
}