
        <?php
    // return all songs from database
    include('config/dbConfig.php');

    $tableName = "songs";

    $result = $conn->query("SELECT * FROM $tableName");

    $records = [];
    if ($result->num_rows > 0)
    {
        $return_arr = array();
        
        while($row = $result->fetch_assoc()) {
            array_push($return_arr, $row);
           
         
        } 
        echo json_encode($return_arr);
    } else {
        echo "0 results";
    }
   $conn->close();
?>