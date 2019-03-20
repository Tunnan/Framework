<?php

// Initialize the router
$router = new Tunnan\Framework\Includes\Router();

// Define all routes down here, examples:
// $router->get('', 'WelcomeController@index');
// $router->get('users/{:int}', 'UsersController@view');
// $router->get('users/{:string}', function($name) { // ..  });
// $router->resource('users', 'UserController');

$router->get('', function() { debug('Welcome'); });
$router->resource('users', 'UserController');
$router->get('users/login', 'UserController@login');
$router->get('users/logout', 'UserController@logout');
