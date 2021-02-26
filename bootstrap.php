<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

function getEntityManager () {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $dbParams  = array (
        'host'     => $_ENV['DATABASE_HOST'],
        'port'     => $_ENV['DATABASE_PORT'],
        'dbname'   => $_ENV['DATABASE_NAME'],
        'user'     => $_ENV['DATABASE_USER'],
        'password' => $_ENV['DATABASE_PASSWD'],
        'driver'   => $_ENV['DATABASE_DRIVER'],
        'charset'  => $_ENV['DATABASE_CHARSET']
    );

    $config = Setup::createAnnotationMetadataConfiguration(
        array($_ENV['ENTITY_DIR']),
        $_ENV['DEBUG'],
        ini_get('sys_temp_dir'),
        null,
        false        
    );
    $config->setAutoGenerateProxyClasses(true);
    if ($_ENV['DEBUG']) {
        $config->setSQLLogger(new \Doctrine\DBAL\logging\EchoSQLLoger());
    }

    return EntityManager::create($dbParams, $config);

}
