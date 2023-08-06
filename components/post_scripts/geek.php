<?php
session_start();
if(!isset($_SESSION["uid"]))
{
    header("Location: ../login/");
    exit();
}
require_once("../../db_connect.php");

$query="INSERT INTO geek(geekers_uid,discussion_id) VALUES(1,1)";

mysqli_query($conn,$query);

echo "Geeked";
?>
