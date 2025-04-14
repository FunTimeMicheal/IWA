<?php
namespace IWA\Application\Routes;

use IWA\Application\Routes\Api\StationsController;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class ViewsController {
  public function __invoke(RouteCollectorProxy $group) {
    $group->get("/", function (Request $request, Response $response, array $args) {
      $renderer = new PhpRenderer(getcwd() . "/src/views");
      return $renderer->render($response, "index.php");
    });

    $group->get("/stations", function (Request $request, Response $response, array $args) {
      $renderer = new PhpRenderer(getcwd() . "/src/views");

      
      return $renderer->render($response, "stations.php");
    });

    $group->get("/companies", function (Request $request, Response $response, array $args) {
      $renderer = new PhpRenderer(getcwd() . "/src/views");
      return $renderer->render($response, "companies.php");
    });

    $group->get("/contracts", function (Request $request, Response $response, array $args) {
      $renderer = new PhpRenderer(getcwd() . "/src/views");
      return $renderer->render($response, "contracts.php");
    });

    $group->get("/roles", function (Request $request, Response $response, array $args) {
      $renderer = new PhpRenderer(getcwd() . "/src/views");
      return $renderer->render($response, "roles.php");
    });

    $group->get("/users", function (Request $request, Response $response, array $args) {
      $renderer = new PhpRenderer(getcwd() . "/src/views");
      return $renderer->render($response, "users.php");
    });

    $group->get("/login", function (Request $request, Response $response, array $args) {
      $renderer = new PhpRenderer(getcwd() . "/src/views");
      return $renderer->render($response, "login.php");
    });
  }
}