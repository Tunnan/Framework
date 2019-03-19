<?php

namespace Tunnan\Framework\Includes;

class Model
{
  // The database connection
  protected static $connection;

  // Set the connection
  public function set_connection($connection)
  {
    static::$connection = $connection;
  }

  // Get all records
  public static function get()
  {
    $h = self::$connection->prepare("SELECT id, created_at, username FROM users");
    $h->execute();
    return $h->fetchAll();
  }

  // Find a record by id
  public static function find($id)
  {
    $h = self::$connection->prepare("SELECT id, created_at, username FROM users WHERE id = :id");
    $h->execute([':id' => $id]);
    return $h->fetch();
  }
}
