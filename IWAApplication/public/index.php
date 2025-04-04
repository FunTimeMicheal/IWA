<?php
use Slim\Factory\AppFactory;
use IWA\Application\Routes\ViewsController;

chdir(__DIR__ . "/..");
require getcwd() . '/vendor/autoload.php';

$app = AppFactory::create();

$app->group('', new ViewsController());

$app->run();
