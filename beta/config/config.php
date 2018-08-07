<?php

/* Database credentials. Assuming you are running MySQL

server with default setting (user 'root' with no password) */

define('DB_SERVER', 'localhost');

define('DB_USERNAME', 'whistle3_john');

define('DB_PASSWORD', 'Jamaz0n!');

define('DB_NAME', 'whistle3_setlist');

    

/* Attempt to connect to MySQL database */

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    

// Check connection

if($link === false){

    die("ERROR: Could not connect. " . mysqli_connect_error());

}

?>