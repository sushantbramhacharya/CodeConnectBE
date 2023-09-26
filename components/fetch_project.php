<?php
    session_start();
    require_once("../db_connect.php");
    $uid = $_GET["uid"];
    $project_id = $_GET["project_id"];
    $query="SELECT * FROM projects WHERE uid = $uid AND pid=$project_id  LIMIT 1;";
    $result=mysqli_query($conn,$query);
    $projects=array();
    while($row=$result->fetch_assoc())
    {
        $projects[]=array(
            "name"=>$row['name'],
            "description"=>$row['description'],
            "repo"=>$row['repo']
        );
    }
    echo json_encode($projects);
?>