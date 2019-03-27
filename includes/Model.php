<?php

namespace Tunnan\Framework\Includes;

class Model {
  // The database connection
  protected static $connection;

  // Set the connection
  public function set_connection($connection) {
    static::$connection = $connection;
  }

  // Get all records
  public static function get() {
    $h = self::$connection->prepare("SELECT * FROM users");
    return $h->execute() ? $h->fetchAll() : $h->errorInfo();
  }

  // Find a record by id
  public static function find($id) {
    $h = self::$connection->prepare("SELECT * FROM users WHERE id = :id");
    return $h->execute([':id' => $id]) ? $h->fetch() : $h->errorInfo();
  }
}
