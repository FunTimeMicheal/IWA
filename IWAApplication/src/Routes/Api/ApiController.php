<?php
namespace IWA\Application\Routes\Api;

use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ApiController {
  public function __invoke(RouteCollectorProxy $group) {
    $group->group('/contracts', new ContractsController());
    $group->group('/users', new UsersController());
    $group->group('/companies', new CompaniesController());
    $group->group('/stations', new StationsController());

    $group->post("/ingest", function (Request $request, Response $response, array $args) {});
  }
}