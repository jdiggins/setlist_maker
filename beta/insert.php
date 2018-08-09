<?php
// Initialize the session
session_start();

$title_err = $time_err = "";
$title_hold = "";
$time_hold = "0";
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
if(isset($_POST['add_user']))
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
    
   $sql = "INSERT INTO $tableName (username, title, length1, songkey, song_quality, splittable) VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ssissi", $_SESSION['username_setlist'], $_POST['title'], $_POST['time'],
    $_POST['songkey'], $_POST['song_quality'], $_POST['splittable']);
    if($stmt->execute()) {
        echo 'Song entered successfully';
    } else {
        echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
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
    </style>
     <script type="text/javascript" src="setlist_creator.js"></script>

</head>

<body>

    <div class="page-header">

        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username_setlist']); ?></b>. Let's enter some songs.</h1>

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
            <input type="number" min=0 name="time" value ="<?php echo $time_hold ?>" class="form-control">
            <span class="help-block"><?php echo $time_err; ?></span>
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
            <input type="submit" name="add_user" class="btn btn-danger"></td>
        </div>
   
    

</form>
</div>

<p><a href="welcome.php" class="btn btn-danger">Back</a></p><br>

</body>

</html>