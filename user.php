<?php
require_once("cors.php");
require_once("db_connect.php");

$user_id = 1;
$sql = "SELECT * FROM User WHERE uid = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();

    
    $json_data = json_encode($row);

    
    echo $json_data;
} else {
    echo "User not found!";
}


$conn->close();


?>