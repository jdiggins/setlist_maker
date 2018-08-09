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
        .my-main-message {
            width: 40%;
            margin: auto;
            text-align: center; 
            padding: 30px 30px 30px 30px;
        }
    </style>
     
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Setlist Maker</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="welcome.php">The Generator</a></li>
            <li><a href="insert.php">Insert Songs</a></li>
            <li class="active"><a href="settings.php">User Settings</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
    </nav>


    <div class="page-header">

        <h1>We're sorry, <b><?php echo htmlspecialchars($_SESSION['username_setlist']); ?></b>. No settings are available yet.</h1>
        

    </div>
    <div class="my-main-message">
        <p>
        <h2>Soon you will be able to customize the generator to your needs! Until then, I hope you enjoy it as it.</h2>
    </p>
    </div>
</body>

</html>