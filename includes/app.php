<?php

namespace Tunnan\Framework\Includes;

use Tunnan\Framework\Includes\Model;

class App
{
  public function __construct($router, $connection = null)
  {
    // Set the connection
    if (!is_null($connection))
    {
      Model::set_connection($connection);
    }

    // Try to find a matching route
    if (!$router->match())
    {
      debug('Route not found');
    }
  }
}
