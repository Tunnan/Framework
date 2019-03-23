<?php

namespace Tunnan\Framework\App\Controllers;

use Tunnan\Framework\Includes\View;

class WelcomeController {
  // Index
  public function index() {
    return new View('welcome.index');
  }
}
