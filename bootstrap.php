<?php
require_once "vendor/autoload.php";
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use App\Config\Database;

// set the default timezone 
date_default_timezone_set('Asia/Kuala_Lumpur');

// start session to keep facebook_access_token
if (!session_id()) {
    session_start();
}

// create a "default" Doctrine ORM configuration for annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/app"), $isDevMode);

// create database connection configuration
$conn = Database::getInstance();

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
