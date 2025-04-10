<?php

use IWA\Application\Database\Entities\Measurement;
$entityManager = require_once "../bootstrap.php";

$station = $argv[1];
try {
    $date_time = new DateTime($argv[2]);
} catch (Exception $e) {
    die("ongeldige DateTime opgegeven: ".$argv[2]. "foutmelding: ".$e->getMessage()."\n");
}
$temperature = $argv[3];
$invalid_temperature = $argv[4];
$dewpoint_temperature = $argv[5];
$air_pressure_station = $argv[6];
$air_pressure_sea_level = $argv[7];
$visibility = $argv[8];
$wind_speed = $argv[9];
$percipation = $argv[10];
$snow_depth = $argv[11];
$conditions = $argv[12];
$cloud_cover = $argv[13];
$wind_direction = $argv[14];
$missing_fields = $argv[15];

$measurement = new Measurement(
    $station,
    $date_time,
    $temperature,
    $invalid_temperature,
    $dewpoint_temperature,
    $air_pressure_station,
    $air_pressure_sea_level,
    $visibility,
    $wind_speed,
    $percipation,
    $snow_depth,
    $conditions,
    $cloud_cover,
    $wind_direction,
    $missing_fields
);

$entityManager->persist($measurement);
$entityManager->flush();

echo "new measurement added: ". $measurement->get_ID()."\n";


