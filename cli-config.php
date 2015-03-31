<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once ROOT.DS.'application/bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
$paths = array(ENTITIES);
$isDevMode = Config::get('doctrine_dev_mode') ? true : false;

// the connection configuration
$dbParams = Config::get('doctrine');
$config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = Doctrine\ORM\EntityManager::create($dbParams, $config);

return ConsoleRunner::createHelperSet($entityManager);