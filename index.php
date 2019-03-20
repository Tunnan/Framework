<?php

// todo
// Find a good way to use Auth with controller methods.
// Instead of calling Auth::logged_in() on every method
// it need to check if the user is logged in, there should
// be some kind of hook in the constructor or something.
// Example:
// $this->hooks->auth(
//   'create' => ['logged_in', 'admin'],
//   'edit'   => ['logged_in'],
// );

// todo
// Create something to handle errors instead of using 
// debug() for errors

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
include ROOT . '/includes/auth.php';

// Include the routes, storing them in $router
include ROOT . '/app/routes.php';

// Initialize the app
new Tunnan\Framework\Includes\App(
  $router, 
  new PDO('mysql:host=localhost;dbname=framework', 'root', '', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
  ])
);
