<?php 
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required([
    'DATABASE_HOST',
    'DATABASE_NAME',
    'DATABASE_USER',
    'DATABASE_PASSWD',
    'DATABASE_DRIVER',
]);

require_once __DIR__ . '/bootstrap.php';
$entitymanager = getEntityManager();
return ConsoleRunner::createHelperSet($entitymanager);