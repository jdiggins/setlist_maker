<?php

session_start();
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
// Include config file
require_once 'config/config.php';

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){

    header('location:login.php');
  
    exit;
  
  }

$tableName = "songs";
$curr_user = $_SESSION['username'];


$result = $link->query("SELECT * FROM $tableName WHERE username='$curr_user'");

$records = [];
if ($result->num_rows > 0)
{
    $return_arr = array();
    
    while($row = $result->fetch_assoc()) {
        array_push($return_arr, $row);
        
        
    } 
    echo json_encode($return_arr);
} else {
    echo "0 results";
}
$link->close();
?>