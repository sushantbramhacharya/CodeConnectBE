<?php
require_once("../../db_connect.php");

session_start();
if (isset($_SESSION["uid"]) && isset($_POST["discussion_id"])&&isset($_POST["check_saved"]))
{
    $uid = $_SESSION["uid"];
    $discussion_id = $_POST["discussion_id"];


    $check_query = "SELECT * FROM saved WHERE uid = '$uid' AND discussion_id = '$discussion_id'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo "already_saved";
    }
}
else if (isset($_SESSION["uid"]) && isset($_POST["discussion_id"])) {
    $uid = $_SESSION["uid"];
    $discussion_id = $_POST["discussion_id"];


    $check_query = "SELECT * FROM saved WHERE uid = '$uid' AND discussion_id = '$discussion_id'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0 && isset($_POST["post"])) {
        $insert_query = "DELETE FROM saved WHERE discussion_id='$discussion_id' AND uid ='$uid'";

        if (mysqli_query($conn, $insert_query)) {
            echo "deleted";
        } else {
            echo "error";
        }
    }
    else if (mysqli_num_rows($check_result) > 0) {
        echo "already_saved";
    } else {
        
        $insert_query = "INSERT INTO saved (uid, discussion_id) VALUES ('$uid', '$discussion_id')";

        if (mysqli_query($conn, $insert_query)) {
            echo "success";
        } else {
            echo "error";
        }
    }
} else {
    var_dump($_POST);
}
?>
