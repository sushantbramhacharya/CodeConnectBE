<?php
session_start();
require_once("../db_connect.php");
if(isset($_POST["method"]))
{
    if($_POST["method"]==="SEND")
    {
        $sender_uid=$_SESSION["uid"];
        $reciever_uid=$_POST["reciever_uid"];
        $post_query = "INSERT INTO connections(sender_uid,reciever_uid,status_accepted) VALUES($sender_uid,$reciever_uid,false);";
        mysqli_query($conn, $post_query);
    }
}
else 
if(isset($_GET["method"])&&$_GET["method"]==="CHECK")
{
    $sender_uid=$_SESSION["uid"];
    $reciever_uid=$_GET["reciever_uid"];
    $post_query = "SELECT * FROM connections WHERE sender_uid=$sender_uid AND reciever_uid=$reciever_uid;";
    $response=array();
    $connection_check_result=mysqli_query($conn, $post_query);
    $row=$connection_check_result->fetch_assoc();
    
    if($connection_check_result->num_rows>0)
    {
        if($row["status_accepted"])
        {
            $response="Accepted";
            echo json_encode($response);
        }
        else{
            $response="Requested";
            echo json_encode($response);
        }
    }
    else
    {
        $response="No Data";
        echo json_encode($response);
    }
}
?>