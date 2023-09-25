<?php
session_start();
if(isset($_SESSION["uid"]))
{
    $uid = $_SESSION["uid"];
    require_once("../db_connect.php");
    if(isset($_POST["reciever"]))
    {
        $reciever=$_POST["reciever"];
        $message=$_POST["message"];
        $query="INSERT INTO messages(sender,reciever,message,timestamp) VALUES('".$uid."','".$reciever."','".$message."','".time()."');";
        if(mysqli_query($conn,$query))
        {
            
        }
    }
    else{
    $fetch_id=$_GET["uid"];

    $messages = array();
    $query="SELECT * FROM messages WHERE (sender = $fetch_id AND reciever = $uid) OR (reciever = $fetch_id AND sender = $uid) ORDER BY timestamp ASC LIMIT 50";
    $result=mysqli_query($conn,$query);
    if ($result == true) {
        while ($row = $result->fetch_assoc()) {
            $sender_uid=$row['sender'];
            $sender="me";
            if($sender_uid!=$uid)
            {
                $q="SELECT Name FROM user WHERE uid=$sender_uid;";
                $r=mysqli_query($conn,$q);
                $rr=$r->fetch_assoc();
                $sender=$rr["Name"];
            }
            $messages[] = array(
               "sender"=>$sender,
               "message"=>$row['message']
            );
        }
    } else {
        echo "Something went wrong!<BR>";
    }
}
echo json_encode($messages);
}
else{
    echo "No access";
}

?>