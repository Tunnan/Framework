<?php

namespace Tunnan\Framework\Includes;

use Tunnan\Framework\Includes\Auth;
use Tunnan\Framework\Includes\Model;

class App {
  public function __construct($router, $connection = null) {
    // Set the connection
    if (!is_null($connection)) {
      Model::set_connection($connection);

      // Store a logged in user.
      // This needs a user model to work
      Auth::store($connection);
    }

    // Try to find a matching route
    if (!$router->match()) {
      debug('Route not found');
    }

    // Clear all flash messages
    Flash::clear();
  }
}
