<?php

session_start();
if(!isset($_SESSION["uid"]))
{
    header("Location: ../login/");
    exit();
}

require_once("../db_connect.php");
if(isset($_SESSION["uid"]))
{
    $sid=$_SESSION["uid"];
    $query = "SELECT * FROM User Where uid ='$sid';";
    $result=mysqli_query($conn,$query);
    $user=mysqli_fetch_assoc($result); 
}


?>