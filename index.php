<?php

session_start();

define('ROOT', realpath(dirname(__FILE__)));

// Composer autoloader
require ROOT . '/vendor/autoload.php';

// Include the core files
include ROOT . '/includes/functions.php';
include ROOT . '/includes/csrf.php';
include ROOT . '/includes/model.php';
include ROOT . '/includes/router.php';
include ROOT . '/includes/view.php';
include ROOT . '/includes/app.php';

// Include the routes, storing them in $router
include ROOT . '/app/routes.php';

// Initialize the app
new Tunnan\Framework\Includes\App(
  $router, 
  new PDO('mysql:host=localhost;dbname=framework', 'root', '', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
  ])
);
