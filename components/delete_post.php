<?php
session_start();
require_once("../db_connect.php");
if(isset($_POST["discussion_id"]))
{
    $uid = $_SESSION["uid"];
    $discussion_id = $_POST["discussion_id"];


    $query = "DELETE FROM discussion WHERE discussion_id = '$discussion_id' AND uid = '$uid'";
    mysqli_query($conn, $query);
    echo "success";
}
?>