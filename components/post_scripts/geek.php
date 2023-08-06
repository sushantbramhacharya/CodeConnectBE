<?php
session_start();
if(!isset($_SESSION["uid"]))
{
    header("Location: ../../login/");
    exit();
}

if(isset($_POST['geekers_uid'])&&isset($_POST['discussion_id'])&&$_POST['geeking']==="true")
{
    require_once("../../db_connect.php");

    $geekers_uid=$_POST['geekers_uid'];
    $discussion_id=$_POST['discussion_id'];
    
    if(!user_has_geeked($geekers_uid,$discussion_id,$conn))
    {
    
    $query="INSERT INTO geek(geekers_uid,discussion_id) VALUES($geekers_uid,$discussion_id)";
    
    mysqli_query($conn,$query);
    
    echo "Geeked";
    }
    else{
        $query="DELETE FROM geek WHERE geekers_uid = '$geekers_uid' AND discussion_id = '$discussion_id';";
    
        mysqli_query($conn,$query);
        echo "geek remove";
    }
    exit();
}
else if(isset($_POST['discussion_id'])&&$_POST['geeking']==="false")
{
    require_once("../../db_connect.php");
    $discussion_id=$_POST['discussion_id'];
    $query= "SELECT * FROM geek WHERE discussion_id = '$discussion_id';";
    $result= mysqli_query($conn,$query);
    $geeker_of_discussion_name = array();

    // Fetch the data as an associative array and store it in the $data array
    if($result->num_rows>3)
    {
        for($i=0;$i<3;$i++) 
        {
                $row = $result->fetch_assoc();
                $geekers_uid=$row["geekers_uid"];
                $query="SELECT Name FROM user WHERE uid = '$geekers_uid';";
                $result_name= mysqli_query($conn,$query);
                $geeker_of_discussion_name[] = $result_name->fetch_assoc();   
        }
    }
    else{
        while($row = $result->fetch_assoc()) 
        {
                $geekers_uid=$row["geekers_uid"];
                $query="SELECT Name FROM user WHERE uid = '$geekers_uid';";
                $result_name= mysqli_query($conn,$query);
                $geeker_of_discussion_name[] = $result_name->fetch_assoc();   
        }
    }
    
    $count=$result->num_rows-3;
    $geeker_of_discussion_name[]["count"]="$count";
    echo json_encode($geeker_of_discussion_name);
}
else{
    header("Location: ../../login/");
    exit();
}


//geek checker
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
