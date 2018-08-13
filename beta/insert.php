<?php
// Initialize the session
session_start();

$title_err = $time_err = "";
$title_hold = "";
$time_hold = "4";
$success = "";
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username_setlist']) || empty($_SESSION['username_setlist'])){
  header("location: login.php");
  exit;
}
?>
<?php
require_once 'config/config.php';
$tableName = "songs";
// parse post data & submit to database
if(isset($_POST['add_song']))
{
    
    if(empty(trim($_POST["title"])) || empty(trim($_POST["time"]))) {
        if(empty(trim($_POST["title"]))){
            $title_err = 'Please enter a title.';
        }
        if(empty(trim($_POST["time"]))) {
            $time_err = 'Please enter an amount of time.';
        } 
        $title_hold = trim($_POST["title"]);
        $time_hold = trim($_POST["time"]);
    } else {
        
        $sql = "INSERT INTO $tableName (username, title, length1, tempo, songkey, song_quality, splittable) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "ssiissi", $_SESSION['username_setlist'], $_POST['title'], $_POST['time'],
            $_POST['tempo'], $_POST['songkey'], $_POST['song_quality'], $_POST['splittable']);
 

            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){
                // success message
                $success = "Success";

            } else{
                $success = "I'm sorry but I can't do this for you right now!";
                // Error
                echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
            }

        }
    
    $stmt->close();
    $link->close();
}
}
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Insert Songs</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

    <style type="text/css">

        body{ font: 14px sans-serif; text-align: center; }
        .wrapper{ margin: auto; width: 350px; padding: 20px; text-align: center; }

        
        .success-mess{
            margin: auto;  padding: 20px; text-align: center;
            opacity: 0;
            animation-name: fadeInOut;
            animation-duration: 7s;

            background-color: #333; /* Black background color */
            color: #fff; /* White text color */
            border-radius: 2px; /* Rounded borders */
            position: fixed; /* Sit on top of the screen */
            bottom: 30px; /* 30px from the bottom */
            width: 150 px;
            transform: translateX(-50%);
            left: 50%;
        }
        
        @keyframes fadeInOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
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
            <li><a href="welcome.php">The Generator</a></li>
            <li class="active"><a href="insert.php">Insert Songs</a></li>
            <li><a href="settings.php">User Settings</a></li>
            <li><a href="about.php">About</a></li>
            </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
    </nav>

    <div class="page-header">

        <h1><b><?php echo htmlspecialchars($_SESSION['username_setlist']); ?></b>, let's enter some songs.</h1>

    </div>
    <div class="wrapper">
        <form method="post">
        <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
            <label>Title</label>
            <input type="text" name="title" value="<?php echo $title_hold ?>" class="form-control">
            <span class="help-block"><?php echo $title_err; ?></span>
        </div>  
        <div class="form-group <?php echo (!empty($time_err)) ? 'has-error' : ''; ?>">
            <label>Approx Song Length:</label>
            <input type="number" min=0 max=20 name="time" value ="<?php echo $time_hold ?>" class="form-control">
            <span class="help-block"><?php echo $time_err; ?></span>
        </div> 
        <div class="form-group">
            <label>Tempo (bpm):</label>
            <input type="number" min=1 name="tempo" value ="120" class="form-control">
        </div> 
        <div class="form-group">
            <label>Song Key:</label>
            <select name="songkey" class="form-control">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="G">G</option>
                <option value="Ab">Ab</option>
                <option value="Bb">Bb</option>
                <option value="Db">Db</option>
                <option value="Eb">Eb</option>
                <option value="Gb">Gb</option>
            </select>

        </div> 
        <div class="form-group">
            <label>Major / Minor:</label>
            <select name="song_quality" class="form-control">
                <option value="major">Major</option>
                <option value="minor">Minor</option>
            </select>
        </div> 
        <div class="form-group">
            <label>Splittable?</label>
            <select name = "splittable" class="form-control">
            <option value=1>Yes</option>
            <option value=0>No</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="add_song" class="btn btn-danger" value="Insert Song"></td>
        </div>

        <script>
        console.log("<?php echo ($success); ?>");
        if("<?php echo htmlspecialchars($success); ?>" != "") {
            console.log("inside function");
        var newDiv = document.createElement("div");
            newDiv.className="success-mess";
            newDiv.appendChild(document.createTextNode("<?php echo htmlspecialchars($success); ?> "));
        
            document.body.appendChild(newDiv);
        }
</script>
        
    

</form>
</div>



</body>

</html>