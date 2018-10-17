<?php

namespace Controllers;

use Application\Dto\LocationDto;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class LocationController
{
    protected $locationQuery;
    protected $addLocationCommand;
    protected $updateLocationCommand;


    public function __construct(ContainerInterface $container)
    {
        $this->locationQuery = $container->get('ILocationQuery');
        $this->addLocationCommand = $container->get('IAddLocationCommand');
        $this->updateLocationCommand = $container->get('IUpdateLocationCommand');
    }

    public function getLocation(Request $request, Response $response, array $args = null) :Response
    {
        $id= (int)$args['id'];
        $location = $this->locationQuery->getById($id);
        return $response->withJson($location);
    }

    public function createLocation(Request $request, Response $response, array $args = null) :Response
    {
        $requestObj = json_decode($request->getBody(),true);
        $locationDto = $this->getLocationDtoFromRequest($requestObj);
        $this->addLocationCommand->create($locationDto);
        return $response;
    }

    public function updateLocation(Request $request, Response $response, array $args = null) :Response
    {
        $id= (int)$args['id'];
        $requestObj = json_decode($request->getBody(), true);
        $locationDto = $this->getLocationDtoFromRequest($requestObj);
        $this->updateLocationCommand->update($id,$locationDto);
        return $response;
    }

    /**
     * @param $requestObj
     * @return LocationDto
     */
    public function getLocationDtoFromRequest($requestObj)
    {
        $locationDto = new LocationDto();
        array_key_exists("address", $requestObj) ? $locationDto->address =  $requestObj['address'] : null ;
        array_key_exists("city", $requestObj) ? $locationDto->city =  $requestObj['city'] : null ;
        array_key_exists("country", $requestObj) ? $locationDto->country =  $requestObj['country'] : null ;
        array_key_exists("latitude", $requestObj) ? $locationDto->latitude =  $requestObj['latitude'] : null ;
        array_key_exists("locationName", $requestObj) ? $locationDto->locationName =  $requestObj['locationName'] : null ;
        array_key_exists("longitude", $requestObj) ? $locationDto->longitude =  $requestObj['longitude'] : null ;
        array_key_exists("phone", $requestObj) ? $locationDto->phone =  $requestObj['phone'] : null ;
        array_key_exists("postalCode", $requestObj) ? $locationDto->postalCode =  $requestObj['postalCode'] : null ;
        array_key_exists("state", $requestObj) ? $locationDto->state =  $requestObj['state'] : null ;


        return $locationDto;
    }

}