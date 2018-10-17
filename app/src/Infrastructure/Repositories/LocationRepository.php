<?php

namespace Infrastructure\Repositories;


use Application\Dto\LocationDto;
use Domain\Repository\ILocationRepository;


class LocationRepository implements ILocationRepository
{

    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function read($id)
    {
        $location = $this->pdo->query('SELECT * FROM Location where id = ' . $id)->fetchObject();
        return $location;
    }

    public function create(LocationDto $location)
    {
        $statement = $this->pdo->prepare("Insert into Location (address,city,country,latitude,locationName,longitude,phone,postalCode,state) 
                                                        values (:address,:city,:country,:latitude,:locationName,:longitude,:phone,:postalCode,:state)");
        $statement->bindParam(":address",$location->address);
        $statement->bindParam(":city",$location->city);
        $statement->bindParam(":country",$location->country);
        $statement->bindParam(":latitude",$location->latitude);
        $statement->bindParam(":locationName",$location->locationName);
        $statement->bindParam(":longitude",$location->longitude);
        $statement->bindParam(":phone",$location->phone);
        $statement->bindParam(":postalCode",$location->postalCode);
        $statement->bindParam(":state",$location->state);
        $statement->execute();
    }

    public function update($location)
    {
        $statement = $this->pdo->prepare("Update Location Set 
                                          address = :address  ,city = :city  ,country = :country ,
                                          latitude = :latitude ,locationName = :locationName ,
                                          longitude = :longitude ,phone = :phone,
                                          postalCode  = :postalCode,state  = :state where id = :id");
        $statement->bindParam(":id",$location->id);
        $statement->bindParam(":address",$location->address);
        $statement->bindParam(":city",$location->city);
        $statement->bindParam(":country",$location->country);
        $statement->bindParam(":latitude",$location->latitude);
        $statement->bindParam(":locationName",$location->locationName);
        $statement->bindParam(":longitude",$location->longitude);
        $statement->bindParam(":phone",$location->phone);
        $statement->bindParam(":postalCode",$location->postalCode);
        $statement->bindParam(":state",$location->state);
        $statement->execute();
    }
}