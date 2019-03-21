<?php

namespace Tunnan\Framework\Includes;

use Tunnan\Framework\App\Models\User;

class Auth
{
  // Data of the currently logged in user
  private static $user;

  // Store a logged in user, if the user 
  // session is set
  public function store($connection)
  {
    if (isset($_SESSION['uid']))
    {
      $h = $connection->prepare('SELECT id, created_at, username, admin FROM users WHERE id = :id');

      if ($h->execute(['id' => $_SESSION['uid']]))
      {
        self::$user = $h->fetch();
        return true;
      }
      else
      {
        return $h->errorInfo();
      }
    }
  }

  // Return the user data
  public static function user()
  {
    if (!is_null(self::$user))
    {
      return self::$user;
    }
  }

  // Check if the user is logged in
  public static function logged_in()
  {
    return !is_null(self::$user);
  }
  
  // Check if the given id matches the logged in user
  public static function check($id)
  {
    if (!self::logged_in())
    {
      return false;
    }
    
    return self::$user->id == $id;
  }

  // Check if the user is an admin
  public static function is_admin()
  {
    if (!self::logged_in())
    {
      return false;
    }
    
    return self::$user->admin == 1;
  }
}
