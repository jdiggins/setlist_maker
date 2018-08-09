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
            width: 70%;
            margin: auto;
            text-align: center; 
            padding: 30px 30px 30px 30px;
        }
        .about-head {

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
            <li><a href="settings.php">User Settings</a></li>
            <li  class="active"><a href="about.php">About</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
    </nav>


    <div class="page-header">

        <h1><b><?php echo htmlspecialchars($_SESSION['username_setlist']); ?></b>, I'm gonna tell you a little about what I do here.</h1>
        

    </div>
    <div class="my-main-message">
        <p>
        <h2><b>What is this thing? </b></h2>
    </p>
    <p>This is a setlist maker. It was written specifically for bands who like to jam, but there will be custom settings coming to make 
        the setlist generator more user friendly for all bands. </p>
    </div>

    <div class="my-main-message">
        <p>
        <h2><b>How to use the generator </b></h2>
    </p>
    <p>In order to user the setlist generator, first you must insert at least one song. The more songs you insert, the better it will work. 
        Once you have your songs inserted, navigate to the generator and press the "Do That Setlist!" button. You can continue to press the button
        until you find the setlist you desire.
    </p>
    </div>
    <div class="my-main-message">
        <p>
        <h2><b>Inserting Songs </b></h2>
    </p>
    <p>We tried to make this as simple as possible, but we do ask for some information to help the generator do its job.
        The song length will be used to generate setlists for specific lengths of time (feature coming soon!).
        The song key helps the generator do its job, but if you are unsure or don't care you can leave it at the default value. The same goes for
        the Major / Minor option. Splittable means that the song can be split into a first and second half. If you don't want a song to be split, select no.</p>
    </div>
    <div class="my-main-message">
        <p>
        <h2><b>Data we keep </b></h2>
    </p>
    <p>All songs you enter are stored in our database for your own convenience. Once you enter your songs, you never have to go back and enter them again.
        All password are encrypted for your own privacy, and only you can access your stored data. Some usage data is being stored during the beta phase of
        the generator to help make it better.
    </p>
    </div>
</body>

</html>