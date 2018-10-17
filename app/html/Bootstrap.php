<?php


class Bootstrap  extends \DI\Bridge\Slim\App
{
    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions(__DIR__ . 'my-config-file.php');
    }
}

$app = new MyApp;


