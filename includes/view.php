<?php

namespace Tunnan\Framework\Includes;

class View {
  private $template = 'default';

  // Include a new view
  public function __construct($path, $data = []) {
    list($dir, $file) = explode('.', $path);
    extract($data);

    // Store the output buffer for later
    // use within the template
    ob_start();
    include(ROOT . '/app/views/' . $dir . '/' . $file . '.php');
    $this->outlet = ob_get_contents();
    ob_end_clean();

    return $this;
  }

  // Include the template, which 
  // contains $this->view
  public function __destruct() {
    include ROOT . '/app/templates/' . $this->template . '.php';
  }

  // Change template file
  public function template($file) {
    $this->template = $file;
  }
}
