<?php

namespace Tunnan\Framework\App\Controllers;

use Tunnan\Framework\Includes\View;
use Tunnan\Framework\App\Models\User;

class UserController
{
  // Index
  public function index()
  {
    debug(User::get());
    //return new View('users.index');
  }

  // Create
  public function create()
  {
    return new View('users.create');
  }
  
  // Store
  public function store()
  {
    User::create($_POST['name']) ? redirect('users') : debug('Something went wrong. Unique field?');
  }
  
  // Show
  public function show($id)
  {
    debug('Hello ' . $id);
  }
  
  // Edit
  
  // Update
  
  // Destroy
}
