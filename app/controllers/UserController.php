<?php

namespace Tunnan\Framework\App\Controllers;

use Tunnan\Framework\Includes\View;
use Tunnan\Framework\App\Models\User;

class UserController
{
  // Constructor with middleware authentication
  public function __construct()
  {
    // todo implement later
    //$this->middleware('auth', ['except' => ['show']]);
  }

  // Index
  public function index()
  {
    return new View('users.index', [
      'users' => User::get()
    ]);
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
    debug(User::find($id));
  }
  
  // Edit
  public function edit($id)
  {
    return new View('users.edit', [
      'user' => User::find($id)
    ]);
  }
  
  // Update
  public function update($id)
  {
    User::update([
      'id' => $id, 'username' => $_POST['username']
    ]);

    redirect('users/' . $id);
  }
  
  // Destroy
  public function destroy($id)
  {
    debug('Destroy');
  }
}
