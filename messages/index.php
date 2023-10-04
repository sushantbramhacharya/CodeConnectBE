<?php
session_start();

$sid = $_SESSION['uid'] ;
require_once("../db_connect.php");
$resp=array();
$query="SELECT * FROM connections WHERE (sender_uid = $sid or reciever_uid = $sid) AND status_accepted = true";
$result=$conn->query($query);



while($row=$result->fetch_assoc())
{
    $sender_uid = $row["sender_uid"];
    $reciever_uid = $row["reciever_uid"];
    if($sender_uid === $sid)
    {
        $resp["Connections"][]=fetch_name($conn,$reciever_uid);
    }
    else if($reciever_uid === $sid)
    {
        $resp["Connections"][]=fetch_name($conn,$sender_uid);
    }
}
function fetch_name($conn,$uid)
{
    $query="SELECT Name FROM user WHERE uid=$uid";
    $result=$conn->query($query);
    $row=$result->fetch_assoc();
    return $row["Name"];
}
echo json_encode($resp);
?>