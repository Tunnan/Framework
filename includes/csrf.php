<?php

// Generate a CSRF token on load
if (!isset($_SESSION['token']))
{
  $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
}

// Generate a CSRF token input field
function csrf()
{
  return '<input type="text" name="csrf" value="'. $_SESSION['token'] . '"/>';
}

// Verify the CSRF token with the value 
// given by the hidden post field
function csrf_verify($token)
{
  return $_SESSION['token'] === $token;
}
