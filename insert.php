
<!Doctype html>
<html>
    <head>
        <title>Insert New Songs</title>
    </head>
    <body>
        <?php

        include('dbConfig.php');

        // parse post data & submit to database
        if(isset($_POST['add_user']))
        {
            $sql = "INSERT INTO songs (title, length, songkey) VALUES (?, ?, ?)";
            
            $stmt = $conn->prepare($sql);

            $stmt->bind_param("sss", $_POST['title'], $_POST['length'],
            $_POST['songkey']);

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
                <td>Length (approx mins): </td>
                <td><input type="text" name="length"> </td>
            </tr>
            <br>
            <tr>
                <td>Key: </td>
                <td><input type="text" name="songkey"></td>
            </tr>
            <br>
            <tr>
                <td></td>
                <td><select>
                <option value="major">Major</option>
                <option value="minor">Minor</option>
            </select></td>
            </tr>
            <br>
            <tr>
                <td></td>
                <td><input type="submit" name="add_user"></td>
            </tr>
            
      
        </form>
    </body>
</html>