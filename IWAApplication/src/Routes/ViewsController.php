<?php
namespace IWA\Application\Routes;

use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class ViewsController {
  public function __invoke(RouteCollectorProxy $group) {
    $group->get("/", function (Request $request, Response $response, array $args) {
      $renderer = new PhpRenderer(getcwd() . "/src/Views");
      return $renderer->render($response, "index.php");
    });
  }
}