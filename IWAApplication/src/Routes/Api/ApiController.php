<?php
namespace IWA\Application\Routes\Api;

use IWA\Application\Database\DataLogger;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ApiController {
  public function __invoke(RouteCollectorProxy $group) {
    $group->group("/companies", new CompaniesController());
    $group->group("/contracts", new ContractsController());
    $group->group("/roles", new UserRolesController());
    $group->group("/stations", new StationsController());
    $group->group("/users", new UsersController());

    $group->post("/ingest", function (Request $request, Response $response, array $args) {
      $data = $request->getParsedBody();
        if ($data) {
          processWeatherData($data);
          $response->getBody()->write(json_encode([
            'status' => 'success',
            'message' => 'Data ontvangen',
          ]));
          return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
        else {
          $response->getBody()->write(json_encode([
            'status' => 'failed',
            'message' => 'Data missed',
          ]));
        }
    });
  }
}