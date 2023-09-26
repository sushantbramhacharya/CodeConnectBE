<?php
    session_start();
    require_once("../db_connect.php");
    $uid = $_GET["uid"];
    $skill_id = $_GET["skill_id"];
    $query="SELECT * FROM skills WHERE uid = $uid AND skill_id=$skill_id  LIMIT 1;";
    $result=mysqli_query($conn,$query);
    $skills=array();
    while($row=$result->fetch_assoc())
    {
        $skills[]=array(
            "name"=>$row['name'],
            "description"=>$row['description']
        );
    }
    echo json_encode($skills);
?>