<?php
use Doctrine\ORM\EntityManager;
use IWA\Application\Database\Entities\Station;


function transferStation(string $oldData){
    /**
     * @var EntityManager $entityManager
     */
    $entityManager = require getcwd() . "/../bootstrap.php";
    $oldData = substr($oldData, 1, -1);
    $data = explode("),(", $oldData);
    foreach($data as $station){

        $station = explode(",", $station);
        print_r($station);
        $stationinfo = [
            'name' => $station[0],
            'longitude' => $station[1],
            'latitude' => $station[2],
            'elevation' => $station[3]
        ];
        $station = new Station(substr($station[0], 1, -1), $station[1], $station[2],$station[3]);
        $entityManager->persist($station);
        $entityManager->flush();
    }

}
$tester = "('100020',6.367,53.8,6),('100040',6.35,54.167,3)";
transferStation($tester);

