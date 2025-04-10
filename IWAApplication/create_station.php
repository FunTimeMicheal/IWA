<?php
$entityManager = require_once getcwd() . '/src/Database/bootstrap.php';

$name = $argv[1];
$longitude = $argv[2];
$latitude = $argv[3];
$elevation = $argv[4];

$station = new Station($name, $longitude, $latitude, $elevation);

$entityManager->persist($station);
$entityManager->flush();

echo "new station added: ". $station->getName()."\n";