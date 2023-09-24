<?php
session_start();
require_once("../db_connect.php");
function fetchDiscussion($conn,$discussion_id)
{
    $query = 'SELECT * FROM comments WHERE discussion_id='.$discussion_id.';';
    $result=mysqli_query($conn, $query);
    $comments=array();
    while ($row = $result->fetch_assoc()) {
        $commenter_uid=$row["uid"];
        $query = 'SELECT * FROM user WHERE uid='.$commenter_uid.';';
        $result_name=mysqli_query($conn, $query);
        $row_name = $result_name->fetch_assoc();
        $commenter = $row_name['Name'];
        $comment = $row["comment"];
        $comment_id = $row["comment_id"];
        $comments[]=array(
                "commenter_name"=>$commenter,
                "comment"=>$comment,
                "comment_id"=>$comment_id
        );
    }
    return $comments;
}
if(isset($_SESSION['uid']))
{
    if($_SERVER['REQUEST_METHOD']=='GET')
    {
        $discussion_id=$_GET["discussion_id"];
        echo json_encode(fetchDiscussion($conn,$discussion_id));
    }
    else if(isset($_POST['comment_id']))
    {
        $uid=$_SESSION["uid"];
        $comment_id=$_POST['comment_id'];
        $discussion_id=$_POST["discussion_id"];
        $query = 'DELETE FROM comments WHERE comment_id='.$comment_id.';';
        mysqli_query($conn, $query);
        
    
        echo json_encode(fetchDiscussion($conn,$discussion_id));
    }
    else{
        $uid=$_SESSION["uid"];
        $comment=$_POST["comment"];
        $discussion_id=$_POST["discussion_id"];
        $query = 'INSERT INTO comments(uid,discussion_id,comment) VALUES('.$uid.','.$discussion_id.',"'.$comment.'");';
        mysqli_query($conn, $query);
        
    
        echo json_encode(fetchDiscussion($conn,$discussion_id));
    }
}

?>