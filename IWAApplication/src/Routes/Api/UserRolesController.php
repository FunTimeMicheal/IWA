<?php
namespace IWA\Application\Routes\Api;

use IWA\Application\Database\Entities\UserRole;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserRolesController {
    public function __invoke(RouteCollectorProxy $group) {
        /**
         * @var EntityManager $entityManager
         */
        $entityManager = require_once getcwd() . "/src/Database/bootstrap.php";


        $group->get("/", function (Request $request, Response $response) use ($entityManager) {
            $data = $entityManager->getRepository(UserRole::class)->findAll();
            $response->getBody()->write(json_encode($data));
            return $response->withHeader("Content-Type", "application/json");
        });


        $group->get("/{id}", function (Request $request, Response $response, array $args) use ($entityManager) {
            $station = $entityManager->getRepository(UserRole::class)->find($args["id"]);
            $response->getBody()->write(json_encode($station));
            return $response->withHeader("Content-Type", "application/json");
        });


        $group->post("/", function (Request $request, Response $response) use ($entityManager) {
            $data = $request->getParsedBody();

            $station = UserRole::fromArray($data);
            $entityManager->persist($station);
            $entityManager->flush();

            $response->getBody()->write(json_encode($station));
            return $response->withHeader("Content-Type", "application/json");
        });


        $group->patch("/{id}", function (Request $request, Response $response, array $args) use ($entityManager) {
            $data = $request->getParsedBody();

            $station = $entityManager->getRepository(UserRole::class)->find($args["id"]);
            $station->patch($data);

            $response->getBody()->write(json_encode($station));
            return $response->withHeader("Content-Type", "application/json");
        });
    }
}