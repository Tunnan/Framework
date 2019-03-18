<?php

session_start();
define('ROOT', realpath(dirname(__FILE__)));

// Include the core files
include ROOT . '/includes/functions.php';
include ROOT . '/includes/csrf.php';
include ROOT . '/includes/router.php';
include ROOT . '/includes/app.php';

// Include the routes, storing them in $router
include ROOT . '/app/routes.php';

// Initialize the app
new App($router);
