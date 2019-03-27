<?php

namespace Tunnan\Framework\Includes;

class Registry {
  // The data stored within the registry
  private static $data = [];

  // Store a value into the registry
  public static function set($name, $value) {
    self::$data[$name] = $value;
  }

  // Get a value from the registry
  public static function get($name) {
    return isset(self::$data[$name]) ? self::$data[$name] : null;
  }
}
