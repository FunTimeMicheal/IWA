<?php
namespace IWA\Application\Routes\Api;

use Doctrine\ORM\EntityManager;
use IWA\Application\Database\Entities\Geolocation;
use IWA\Application\Database\Entities\Station;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class StationsController {
  public function __invoke(RouteCollectorProxy $group) {
    /**
     * @var EntityManager
     */
    $entityManager = require_once getcwd() . "/src/Database/bootstrap.php";


    $group->get("/", function (Request $request, Response $response) use ($entityManager) {
      $data = $entityManager->getRepository(Station::class)->findAll();
      $response->getBody()->write(json_encode($data));
      return $response->withHeader("Content-Type", "application/json");
    });


    $group->get("/{id}", function (Request $request, Response $response, array $args) use ($entityManager) {
      $station = $entityManager->getRepository(Station::class)->find($args["id"]);
      $response->getBody()->write(json_encode($station));
      return $response->withHeader("Content-Type", "application/json");
    });


    $group->post("/", function (Request $request, Response $response) use ($entityManager) {
      $data = $request->getParsedBody();
      $data["nearest_location"] = $entityManager->getRepository(Geolocation::class)->find($data["nearest_location"]);
      
      $station = Station::fromArray($data);
      $entityManager->persist($station);
      $entityManager->flush();
      
      $response->getBody()->write(json_encode($station));
      return $response->withHeader("Content-Type", "application/json");
    });


    $group->patch("/{id}", function (Request $request, Response $response, array $args) use ($entityManager) {
      $data = $request->getParsedBody();
      $data["nearest_location"] = $entityManager->getRepository(Geolocation::class)->find($data["nearest_location"]);
      
      $station = $entityManager->getRepository(Station::class)->find($args["id"]);
      $station->patch($data);
      
      $response->getBody()->write(json_encode($station));
      return $response->withHeader("Content-Type", "application/json");
    });
  }
}