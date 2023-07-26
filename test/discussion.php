<?php
require_once("cors.php");
require_once("db_connect.php");

$sql = "SELECT * FROM Discussion ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    } 
    $json_data = json_encode($rows);


    echo $json_data;
} else {
    echo "User not found!";
}

$conn->close();
?>