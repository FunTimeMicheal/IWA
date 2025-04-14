<?php
namespace IWA\Application\Routes\Api;

use Doctrine\ORM\EntityManager;
use IWA\Application\Database\Entities\Company;
use IWA\Application\Database\Entities\Geolocation;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CompaniesController {
  public function __invoke(RouteCollectorProxy $group) {

      /**
       * @var EntityManager $entityManager
       */
      $entityManager = require getcwd() . "/src/Database/bootstrap.php";

      $group->get("/", function (Request $request, Response $response) use ($entityManager) {
          $data = $entityManager->getRepository(Company::class)->findAll();
          $response->getBody()->write(json_encode($data));
          return $response->withHeader("Content-Type", "application/json");
      });


      $group->get("/{id}", function (Request $request, Response $response, array $args) use ($entityManager) {
          $station = $entityManager->getRepository(Company::class)->find($args["id"]);
          $response->getBody()->write(json_encode($station));
          return $response->withHeader("Content-Type", "application/json");
      });


      $group->post("/", function (Request $request, Response $response) use ($entityManager) {
          $data = $request->getParsedBody();
          $data["location"] = $entityManager->getRepository(Geolocation::class)->find($data["location"]);

          $station = Company::fromArray($data);
          $entityManager->persist($station);
          $entityManager->flush();

          $response->getBody()->write(json_encode($station));
          return $response->withHeader("Content-Type", "application/json");
      });


      $group->patch("/{id}", function (Request $request, Response $response, array $args) use ($entityManager) {
          $data = $request->getParsedBody();
          $data["location"] = $entityManager->getRepository(Geolocation::class)->find($data["location"]);

          $station = $entityManager->getRepository(Company::class)->find($args["id"]);
          $station->patch($data);

          $response->getBody()->write(json_encode($station));
          return $response->withHeader("Content-Type", "application/json");
      });
  }
}