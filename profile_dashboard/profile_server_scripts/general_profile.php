<?php
session_start();
require_once("../../db_connect.php");
if(isset($_SESSION))
{
    $uid = $_SESSION["uid"].""; 
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Check if a file was uploaded without errors
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === 0) {
            $targetDirectory = "../../uploads/"; // Create a directory to store uploads
    
            // Ensure the $uid is valid (e.g., sanitize it to prevent security issues)
            // Here, we're assuming it's a numeric value.
            if (!is_numeric($uid)) {
                echo "Invalid UID.";
                exit;
            }
    
            // Construct the new file name as "$uid.jpg"
            $newFileName = $uid . ".png";
            $targetFile = $targetDirectory . $newFileName;

            if (file_exists($targetFile)) {
                // Delete the existing file
                unlink($targetFile);
            }
    
            // Move the uploaded file to the desired directory with the new name
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                // echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded as $newFileName.";
            } else {
                // echo "Sorry, there was an error uploading your file.";
            }
        }
        if(isset($_POST["username"])&&!empty($_POST["username"])){
            $newValue=$_POST["username"];
            $query="UPDATE user SET Name= '$newValue' WHERE uid='$uid';";
            if(mysqli_query($conn,$query)){
                echo "updated";
            }
            else{
                echo "error";
            }
        }
        if(isset($_POST["location"])&&!empty($_POST["location"])){
            $newValue=$_POST["location"];
            $query="UPDATE user SET Address= '$newValue' WHERE uid='$uid';";
            if(mysqli_query($conn,$query)){
                echo "updated";
            }
            else{
                echo "error";
            }
        }
        if(isset($_POST["email"])&&!empty($_POST["email"])){
            $newValue=$_POST["email"];
            $query="UPDATE user SET Email= '$newValue' WHERE uid='$uid';";
            if(mysqli_query($conn,$query)){
                echo "updated";
            }
            else{
                echo "error";
            }
        }
        if(isset($_POST["github-link"])&&!empty($_POST["github-link"])){
            $newValue=$_POST["github-link"];
            $query="UPDATE user SET github_link= '$newValue' WHERE uid='$uid';";
            if(mysqli_query($conn,$query)){
                echo "updated";
            }
            else{
                echo "error";
            }
        }
        if(isset($_POST["bio"])&&!empty($_POST["bio"])){
            $newValue=$_POST["bio"];
            $query="UPDATE user SET bio= '$newValue' WHERE uid='$uid';";
            if(mysqli_query($conn,$query)){
                echo "updated";
            }
            else{
                echo "error";
            }
        }
    }

require_once("success.php");

    
}
?>