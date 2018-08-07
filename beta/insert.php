<?php

// Initialize the session

session_start();

// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

// If session variable is not set it will redirect to login page

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){

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
    
   $sql = "INSERT INTO $tableName (username, title, length1, length2, songkey, jamkey, song_quality, jam_quality, splittable) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $link->prepare($sql);

    $stmt->bind_param("ssiissssi", $_SESSION['username'], $_POST['title'], $_POST['length1'], $_POST['length2'],
    $_POST['songkey'], $_POST['jamkey'], $_POST['song_quality'], $_POST['jam_quality'], $_POST['splittable']);
    $stmt->execute();

    echo "Song entered successfully";

    $stmt->close();
    $link->close();
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

    </style>
     <script type="text/javascript" src="setlist_creator.js"></script>

</head>

<body>

    <div class="page-header">

        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Let's enter some songs.</h1>

    </div>
    <form method="post">
    <tr>
        <td>Title: </td>
        <td><input type="text" name="title"></td>
    </tr>
    <br>
    <tr>
        <td>Length 1 (approx mins before jam): </td>
        <td><input type="number" min=0 name="length1" value ="0"> </td>
    </tr><br>
    <tr>
        <td>Length 2 (approx mins before jam): </td>
        <td><input type="number" min=0 name="length2" value="0"> </td>
    </tr>
    <br>
    <tr>
        <td>Song Key: </td>
        <td><select name="songkey">
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
    </select></td>
    </tr>
    <tr>
        <td>Major / Minor: </td>
        <td><select name="song_quality">
        <option value="major">Major</option>
        <option value="minor">Minor</option>
    </select></td>
    </tr>
    <br>
    <tr>
        <td>Jam Key: </td>
        <td><select name="jamkey">
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
    </select></td>
    </tr>
    <tr>
        <td>Major / Minor: </td>
        <td><select name="jam_quality">
        <option value="major">Major</option>
        <option value="minor">Minor</option>
    </select></td>
</tr> <br>
    <tr>
        <td>Splittable? </td>
        <td><select name = "splittable">
            <option value=1>Yes</option>
            <option value=0>No</option>
            </select>
    </td>
    </tr>
    <br>
    <tr>
        <td></td>
        <td><input type="submit" name="add_user"></td>
    </tr>
    

</form>

<p><a href="welcome.php" class="btn btn-danger">Account Home</a></p><br>

</body>

</html>