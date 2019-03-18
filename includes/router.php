<?php

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

  // Try to find a matching route
  public function match()
  {
    $server_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    $server_uri    = filter_input(INPUT_SERVER, 'REQUEST_URI');

    foreach ($this->routes[$server_method] as $path => $callback)
    {
      // Reformat the path into proper regex
      $path = preg_replace(
        ['/\//', '/\{(.*?):int\}/', '/\{(.*?):string\}/'],
        ['\\/', '([0-9]+)', '([A-Za-z0-9\-\_]+)'], $path);
      
      // Match the routes path with the server URI
      if (preg_match('/^\/'. $path . '$/i', $server_uri, $matches))
      {
        $this->dispatch($matches, $callback);
        break;
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
      call_user_func_array($callback, $matches);
    }
    // .. otherwise assume it's a string
    else
    {
      list($class, $method) = explode('@', $callback);
      include_once ROOT . '/app/controllers/' . $class . '.php';
      call_user_func_array([$class, $method], $matches);
    }
  }

  // Add a route
  private function add_route($method, $path, $callback)
  {
    $this->routes[$method][$path] = $callback;
  }
}
