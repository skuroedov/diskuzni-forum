<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->setBasePath('/api/v1');

$errorMiddleware = $app->addErrorMiddleware(true, true, true);


$app->run();


