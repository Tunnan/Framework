<?php

namespace Tunnan\Framework\App\Models;

use Tunnan\Framework\Includes\Model;

class User extends Model
{
  // Create a new user
  public static function create($name)
  {
    $h = self::$connection->prepare('INSERT INTO users (username) VALUES (:name)');
    return $h->execute(['name' => $name]) ? true : $h->errorInfo();
  }

  // Update user data
  public static function update($data)
  {
    $h = self::$connection->prepare('UPDATE users SET username = :username WHERE id = :id');
    return $h->execute($data) ? true : $h->errorInfo();
  }
}
