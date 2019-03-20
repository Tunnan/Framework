<?php

namespace Tunnan\Framework\Includes;

class Router
{
  private $routes;

  // Add GET routes
  public function get($path, $callback)
  {
    $this->add_route('GET', $path, $callback);
  }

  // Add POST routes
  public function post($path, $callback)
  {
    $this->add_route('POST', $path, $callback);
  }

  // Add a resource
  public function resource($path, $callback)
  {
    $this->add_route('GET',  $path,                     $callback . '@index');    // Index
    $this->add_route('GET',  $path . '/create',         $callback . '@create');   // Create
    $this->add_route('POST', $path,                     $callback . '@store');    // Store
    $this->add_route('GET',  $path . '/{:int}',         $callback . '@show');     // Show
    $this->add_route('GET',  $path . '/{:int}/edit',    $callback . '@edit');     // Edit
    $this->add_route('POST', $path . '/{:int}/update',  $callback . '@update');   // Update
    $this->add_route('POST', $path . '/{:int}/destroy', $callback . '@destroy');  // Destroy
  }

  // Try to find a matching route
  public function match()
  {
    $server_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    $server_uri    = filter_input(INPUT_SERVER, 'REQUEST_URI');

    foreach ($this->routes[$server_method] as $path => $callback)
    {
      // Reformat the path into proper regex
      $path = preg_replace(
        ['/\//', '/\{:int\}/', '/\{:string\}/'],
        ['\\/', '([0-9]+)', '([A-Za-z0-9\-\_]+)'], $path);

      // Match the routes path with the server URI
      if (preg_match('/^\/'. $path . '$/i', $server_uri, $matches))
      {
        $this->dispatch($matches, $callback);
        return true;
      }
    }

    return false;
  }

  // Call the found matching callback
  private function dispatch($matches, $callback)
  {
    array_shift($matches);

    // Check if the callback is callable ..
    if (is_callable($callback))
    {
      $callback(... $matches);
    }
    // .. otherwise assume it's a string
    else
    {
      list($class, $method) = explode('@', $callback);

      $c_name = 'Tunnan\\Framework\\App\\Controllers\\' . $class;
      $c_inst = new $c_name;

      // Check user privileges
      foreach ($c_inst->auth as $hook => $methods)
      {
        if (in_array($method, $methods))
        {
          if ($hook == 'logged_in') { Auth::logged_in() ?: die('You need to be logged in to access this page'); }
          else if ($hook == 'is_admin') { Auth::is_admin() ?: die('You need to be an admin to access this page'); }
        }
      }

      $c_inst->$method(... $matches);

      //$c_name = 'Tunnan\\Framework\\App\\Controllers\\' . $class;
      //(new $c_name)->$method(... $matches);
    }
  }

  // Add a route
  private function add_route($method, $path, $callback)
  {
    $this->routes[$method][$path] = $callback;
  }
}
