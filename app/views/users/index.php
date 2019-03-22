<?php

if ($messages != null)
{
  foreach ($messages['success'] as $message)
  {
    echo '<p class="flash success">'. $message .'</p>';
  }
}

debug($users);
