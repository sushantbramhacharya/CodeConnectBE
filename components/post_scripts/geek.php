<?php
session_start();
if(!isset($_SESSION["uid"]))
{
    header("Location: ../login/");
    exit();
}
require_once("../../db_connect.php");

if(!user_has_geeked(1,1,$conn))
{

$query="INSERT INTO geek(geekers_uid,discussion_id) VALUES(1,1)";

mysqli_query($conn,$query);

echo "Geeked";
}
else{
    echo "already geeked";
}
function user_has_geeked($geekers_uid,$discussion_id,$conn) 
{
    $query= "SELECT * FROM geek WHERE geekers_uid = '$geekers_uid' AND discussion_id = '$discussion_id';";
    $result= mysqli_query($conn,$query);
    if($result->num_rows>0)
    {
        return true;
    }
    else{
        return false;
    }
}


?>
