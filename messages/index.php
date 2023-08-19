<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
session_start();
$sid = $_SESSION['uid'] ;

require_once("../db_connect.php");
$resp=array();
$query="SELECT Name FROM user WHERE uid=$sid";
$result=$conn->query($query);
$row=$result->fetch_assoc();
$resp['name']=$row["Name"];
echo json_encode(($resp));
?>