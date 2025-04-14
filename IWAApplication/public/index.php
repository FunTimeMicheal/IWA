<?php
use Slim\Factory\AppFactory;
use IWA\Application\Routes\Api\ApiController;
use IWA\Application\Routes\ViewsController;

chdir(__DIR__ . "/..");
require getcwd() . '/vendor/autoload.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();

$app->group('', new ViewsController());
$app->group('/api', new ApiController());

$app->run();
