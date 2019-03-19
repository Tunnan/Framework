<?php

namespace Tunnan\Framework\App\Models;

use Tunnan\Framework\Includes\Model;

class User extends Model
{
  // Create a new user
  public static function create($name)
  {
    $h = self::$connection->prepare("INSERT INTO users (username) VALUES (:name)");
    return $h->execute(['name' => $name]);
  }
}
