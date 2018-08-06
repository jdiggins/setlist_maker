
<!Doctype html>
<html>
    <head>
        <title>Insert New Songs</title>
    </head>
    <body>
        <?php

        include('config/dbConfig.php');
        $tableName = "songs";

        // parse post data & submit to database
        if(isset($_POST['add_user']))
        {
            
           $sql = "INSERT INTO $tableName (title, length1, length2, songkey, jamkey, song_quality, jam_quality, splittable) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);

            $stmt->bind_param("siissssi", $_POST['title'], $_POST['length1'], $_POST['length2'],
            $_POST['songkey'], $_POST['jamkey'], $_POST['song_quality'], $_POST['jam_quality'], $_POST['splittable']);
            $stmt->execute();

            echo "Song entered successfully";

            $stmt->close();
            $conn->close();
        }




        ?>
        <form method="post">
            <tr>
                <td>Title: </td>
                <td><input type="text" name="title"></td>
            </tr>
            <br>
            <tr>
                <td>Length 1 (approx mins before jam): </td>
                <td><input type="number" min=0 name="length1"> </td>
            </tr><br>
            <tr>
                <td>Length 2 (approx mins before jam): </td>
                <td><input type="number" min=0 name="length2"> </td>
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
    </body>
</html>