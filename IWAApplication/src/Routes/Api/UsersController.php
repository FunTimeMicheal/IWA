<?php
namespace IWA\Application\Routes\Api;

use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsersController {
  public function __invoke(RouteCollectorProxy $group) {
    $group->get("/", function (Request $request, Response $response, array $args) {});
    $group->get("/{id}", function (Request $request, Response $response, array $args) {});
    $group->post("/", function (Request $request, Response $response, array $args) {});
    $group->patch("/", function (Request $request, Response $response, array $args) {});
    $group->delete("/", function (Request $request, Response $response, array $args) {});
  }
}