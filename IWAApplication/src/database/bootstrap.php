<?php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [getcwd() . '/src/database/entities'],
    isDevMode: true,
);

$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'path' => getcwd() . '/db.sqlite',
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);