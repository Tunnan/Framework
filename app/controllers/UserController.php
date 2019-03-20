<?php

namespace Tunnan\Framework\App\Controllers;

use Tunnan\Framework\Includes\View;
use Tunnan\Framework\Includes\Auth;
use Tunnan\Framework\App\Models\User;

class UserController
{
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
    Auth::logged_in() ?: die('You need to be logged in to access this page');
    Auth::is_admin() ?: die('You need to be an admin to access this page');

    return new View('users.create');
  }

  // Store
  public function store()
  {
    Auth::logged_in() ?: die('You need to be logged in to access this page');
    Auth::is_admin() ?: die('You need to be an admin to access this page');

    User::create($_POST['name']) ? redirect('users') : debug('Something went wrong. Unique field?');
  }
  
  // Show
  public function show($id)
  {
    if (Auth::check($id))
    {
      debug('Hey, this is you!');
    }
    
    debug(User::find($id));
  }

  // Edit
  public function edit($id)
  {
    Auth::logged_in() ?: die('You need to be logged in to access this page');
    Auth::check($id) ?: die('You cannot edit other users data');

    return new View('users.edit', [
      'user' => User::find($id)
    ]);
  }

  // Update
  public function update($id)
  {
    Auth::logged_in() ?: die('You need to be logged in to access this page');
    Auth::check($id) ?: die('You cannot update other users data');

    User::update([
      'id' => $id, 'username' => $_POST['username']
    ]);

    redirect('users/' . $id);
  }
  
  // Destroy
  public function destroy($id)
  {
    Auth::logged_in() ?: die('You need to be logged in to access this page');
    Auth::check($id) ?: die('You cannot destroy other users data');
    
    debug('Destroy');
  }

  // Login
  public function login()
  {
    // Temporary login
    $_SESSION['uid'] = 1;

    redirect('users');
  }

  // Logout
  public function logout()
  {
    // Temporary logout
    if (isset($_SESSION['uid']))
    {
      unset($_SESSION['uid']);
    }

    redirect('users');
  }
}
