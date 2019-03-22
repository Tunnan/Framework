<?php

session_start();

define('ROOT', realpath(dirname(__FILE__)));


// Define the names of our sessions
define('SESSION_USER_ID',   'uid');
define('SESSION_MESSAGES',  'messages');

// todo define the environment, for development or production

// Generate a CSRF token
if (!isset($_SESSION['token']))
{
  $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
}

// Composer autoloader
require ROOT . '/vendor/autoload.php';

// Include the core files
include ROOT . '/includes/functions.php';
include ROOT . '/includes/Router.php';
include ROOT . '/includes/Model.php';
include ROOT . '/includes/View.php';
include ROOT . '/includes/App.php';
include ROOT . '/includes/Auth.php';
include ROOT . '/includes/Registry.php';
include ROOT . '/includes/Flash.php';

// Include the routes, storing them in $router
include ROOT . '/app/routes.php';

// Initialize the app
new Tunnan\Framework\Includes\App(
  $router, 
  new PDO('mysql:host=localhost;dbname=framework', 'root', '', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
  ])
);
