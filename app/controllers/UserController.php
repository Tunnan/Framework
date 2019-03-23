<?php

namespace Tunnan\Framework\App\Controllers;

use Tunnan\Framework\Includes\View;
use Tunnan\Framework\Includes\Auth;
use Tunnan\Framework\Includes\Registry;
use Tunnan\Framework\Includes\Flash;
use Tunnan\Framework\App\Models\User;

class UserController {
  // Set some hooks
  public function __construct() {
    Registry::set('auth', ['edit']);
  }

  // Index
  public function index() {
    return new View('users.index', [
      'users' => User::get(),
      'messages' => Flash::get()
    ]);
  }

  // Create
  public function create() {
    Auth::is_admin() ?: exit('You need to have admin privileges to access this page');
    return new View('users.create');
  }

  // Store
  public function store() {
    User::create($_POST['name']) ? redirect('users') : debug('Something went wrong. Unique field?');
  }
  
  // Show
  public function show($id) {
    if (Auth::check($id)) {
      debug('Hey, this is you!');
    }
    
    debug(User::find($id));
  }

  // Edit
  public function edit($id) {
    Auth::check($id) ?: exit('You are not allowed to edit other users');

    return new View('users.edit', [
      'user' => User::find($id)
    ]);
  }

  // Update
  public function update($id) {
    User::update([
      'id' => $id, 'username' => $_POST['username']
    ]);

    redirect('users/' . $id);
  }
  
  // Destroy
  public function destroy($id) {
    debug('Destroy');
  }

  // Login
  public function login() {
    // Temporary login
    $_SESSION['uid'] = 1;

    Flash::set('success', 'You have been loggd in');
    redirect('users');
  }

  // Logout
  public function logout() {
    // Temporary logout
    if (isset($_SESSION[SESSION_USER_ID])) {
      unset($_SESSION[SESSION_USER_ID]);
    }

    Flash::set('success', 'You have been logged out');
    redirect('users');
  }
}
