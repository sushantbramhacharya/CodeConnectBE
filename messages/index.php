<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
session_start();
$sid = $_SESSION['uid'] ;

require_once("../db_connect.php");
$resp=array();
$query="SELECT * FROM connections WHERE (sender_uid = $sid or reciever_uid = $sid) AND status_accepted = true";
$result=$conn->query($query);
$row=$result->fetch_assoc();

$sender_uid = $row["sender_uid"];
$reciever_uid = $row["reciever_uid"];

if($sender_uid === $sid)
{
    echo $reciever_uid;
}
else if($reciever_uid === $sid)
{
    echo $sender_uid;
}

$query_name = "SELECT Name FROM user WHERE uid = $reciever_uid OR uid = $sender_uid";
$result=$conn->query($query_name);
$row=$result->fetch_assoc();
echo $result;
?>