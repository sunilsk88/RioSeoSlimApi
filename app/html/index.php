<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = '192.168.99.100';
$config['db']['user']   = 'sunil';
$config['db']['pass']   = 'sunil';
$config['db']['dbname'] = 'DemoCompany';

$app = new \Slim\App(['settings' => $config]);
$container = $app->getContainer();

$container['pdo'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

/** @var \PDO $pdo */
$pdo = $container->get('pdo');
$pdo->prepare("SHOW GLOBAL VARIABLES LIKE '%innodb_log%'");
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['IEmployeeQuery'] = function ($c) {
    return new \Infrastructure\QueryHandlers\EmployeeQueryHandler($c->get('pdo'));
};

$container['IAddEmployeeCommand'] = function ($c) {
    return new \Infrastructure\CommandHandlers\EmployeeCommandHandler($c->get('pdo'));
};


$container['ILocationRepository'] = new \Infrastructure\Repositories\LocationRepository($container->get('pdo'));
$container['ILocationQuery'] =  new \Infrastructure\QueryHandlers\LocationQueryHandler($container->get('ILocationRepository'));
$container['LocationCommandHandler'] = new \Infrastructure\CommandHandlers\LocationCommandHandler($container->get('ILocationRepository'),$container->get('ILocationQuery'));
$container['IAddLocationCommand'] = $container->get('LocationCommandHandler');
$container['IUpdateLocationCommand']  = $container->get('LocationCommandHandler');

$container["IEmployeeLocationRepository"] = new \Infrastructure\Repositories\EmployeeLocationRepository($container->get('pdo'));
$container['IEmployeeLocationQuery'] = new \Infrastructure\QueryHandlers\EmployeeLocationQueryHandler($container->get('IEmployeeLocationRepository'));
$container["EmployeeLocationCommandHandler"] =  new \Infrastructure\CommandHandlers\EmployeeLocationCommandHandler($container->get("IEmployeeLocationRepository"));
$container['IAddEmployeeLocationCommand'] = $container->get('EmployeeLocationCommandHandler');
$container['IDeleteLocationsForEmployeeCommand'] = $container->get('EmployeeLocationCommandHandler');
$container['IUpdateLocationsForEmployeeCommand'] = $container->get('EmployeeLocationCommandHandler');

// auth routes
$app->group('/employee', function () {
    $this->get('get/{id}', \Controllers\EmployeeController::class . ':getEmployee')->setName('getEmployee');
    $this->post('/create', \Controllers\EmployeeController::class . ':createEmployee')->setName('createEmployee');
});

$app->group('/location', function () {
    $this->get('/{id}', \Controllers\LocationController::class . ':getLocation')->setName('getLocation');
    $this->post('/create', \Controllers\LocationController::class . ':createLocation')->setName('createLocation');
    $this->post('/update/{id}', \Controllers\LocationController::class . ':updateLocation')->setName('updateLocation');
});

$app->group('/employeeLocation', function () {
    $this->get('/{id}', \Controllers\EmployeeLocationController::class . ':getEmployeeLocation')->setName('getEmployeeLocation');
    $this->get('/getByName/{name}', \Controllers\EmployeeLocationController::class . ':getEmployeeLocationByName')->setName('getEmployeeLocationByName');
    $this->post('/create', \Controllers\EmployeeLocationController::class . ':createEmployeeLocations')->setName('createEmployeeLocations');
    $this->post('/updateLocationsForEmployee/{id}', \Controllers\EmployeeLocationController::class . ':updateLocationsForEmployee')->setName('updateLocationsForEmployee');
    $this->post('/deleteLocationsForEmployee/{id}', \Controllers\EmployeeLocationController::class . ':deleteLocationsForEmployee')->setName('deleteLocationsForEmployee');
});

$app->run();

