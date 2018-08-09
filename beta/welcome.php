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

    <title>Welcome!</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

    <style type="text/css">

        body{ font: 14px sans-serif; text-align: center; }
        .page-break{
            margin: 5px 0 5px;
            border-bottom: 1px solid #eee;
        }
        .songlist {
            font-family: 'Open Sans Condensed', sans-serif; 
            font-size: 42px;
             font-weight: 700;
              line-height: 48px; 
              margin: 0 0 24px; 
              padding: 0 30px; 
              text-align: center; 
              text-transform: uppercase; 
        }
        .songwrap {
            font-family: 'Open Sans Condensed', sans-serif; 
            font-size: 42px;
             font-weight: 700;
              line-height: 48px; 
              margin: 0 0 24px; 
              padding: 0 30px; 
              text-align: center; 
              text-transform: uppercase;
        }

    </style>
     <script type="text/javascript" src="setlist_creator.js"></script>

</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Setlist Maker</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="welcome.php">The Generator</a></li>
      <li><a href="insert.php">Insert Songs</a></li>
    <li><a href="settings.php">User Settings</a></li>
    </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Logout</a></li>
      </ul>
  </div>
</nav>

    <div class="page-header">

        <h1>Hello <b><?php echo htmlspecialchars($_SESSION['username_setlist']); ?></b>. Welcome to the generator.</h1>
        

    </div>
    

    
    <p><button type="button" onclick="getSongList(30) " class="btn btn-danger">Do That Setlist!</button> </p><br>
    

    <div class="page-break"></div>
</body>

</html>