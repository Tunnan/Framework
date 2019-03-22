<?php

namespace Tunnan\Framework\Includes;

class Flash
{
  // Store a new flash message
  public static function set($type, $message)
  {
    $_SESSION[SESSION_MESSAGES][$type][] = $message;
  }

  // Get all messages
  public static function get()
  {
    if (isset($_SESSION[SESSION_MESSAGES]))
    {
      return $_SESSION[SESSION_MESSAGES];
    }
  }

  // Clear all messages
  public static function clear()
  {
    unset($_SESSION[SESSION_MESSAGES]);
  }
}
