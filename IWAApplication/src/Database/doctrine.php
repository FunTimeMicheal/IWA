<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

$entityManager = require getcwd() . "/src/Database/bootstrap.php";

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);