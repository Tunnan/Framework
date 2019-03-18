<?php

// Initialize the router
$router = new Router();

// Define all routes down here, examples:
// $router->get('', 'WelcomeController@index');
// $router->get('user/{id:int}', 'UsersController@view');
// $router->get('user/{name:string}', function($name) { // ..  });

$router->get('', 'WelcomeController@index');
