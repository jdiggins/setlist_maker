<?php

$servername="localhost";
$username="whistle3_john";
$password="Jamaz0n!";
$dbname="whistle3_setlist";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>