<?php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ ."/../../vendor/autoload.php";

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [getcwd() . '/src/Database/Entities'],
    isDevMode: true,
);

$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/../../db.sqlite',
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);
return $entityManager;
