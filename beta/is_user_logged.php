<?php
session_start();

// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
// Include config file



if(!isset($_SESSION['username_setlist']) || empty($_SESSION['username_setlist'])){

    $log = False;
    echo json_encode($log);
  
  } else {
      $log = True;
    echo json_encode($log);
  }
?>