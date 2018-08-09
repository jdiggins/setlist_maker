<?php

// Initialize the session

session_start();

// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

// If session variable is not set it will redirect to login page

if(!isset($_SESSION['username_setlist']) || empty($_SESSION['username_setlist'])){

    header("location: login.php");
  
    exit;
  
  }

?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Setlist Maker::Settings</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

    <style type="text/css">

        body{ font: 14px sans-serif; text-align: center; }

    </style>
     
</head>

<body>

    <div class="page-header">

        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username_setlist']); ?></b>. Here you can change your user settings.</h1>
        

    </div>
    <h2>Settings coming soon!</h2>
    <p><a href="welcome.php" class="btn btn-danger">Back</a></p><br>
</body>

</html>