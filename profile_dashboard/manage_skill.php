<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add project</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<?php
session_start();
require_once("../db_connect.php");
if(!empty($_POST['skill-name'])&&isset($_SESSION))
{
    $uid = $_SESSION["uid"];
    $name = $_POST["skill-name"];
    $skill_id=$_POST["skill_id"];
    $query="UPDATE skills SET name='$name'  WHERE uid=$uid AND skill_id=$skill_id";
    $result=mysqli_query($conn,$query);
}
if(!empty($_POST['skill-description'])&&isset($_SESSION))
{
    $uid = $_SESSION["uid"];
    $description = $_POST["skill-description"];
    $skill_id=$_POST["skill_id"];
    $query="UPDATE skills SET description='$description'  WHERE uid=$uid AND skill_id=$skill_id";
    $result=mysqli_query($conn,$query);
}
if($_SERVER['REQUEST_METHOD']==="POST"&&isset($_SESSION)){
    require_once("./profile_server_scripts/success.php");
    exit();
}
?>

<body>
    <div class="update-profile">
        <form method="POST" action="manage_post.php">
            <input type="hidden" name="skill_id" value="<?php echo $_GET['skill_id']?>">
            <div class="form-icon">
                <span><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512" fill="white"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"/></svg></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="skill-name" name="skill-name" placeholder="Enter Skill Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="skill-description" name="skill-description" placeholder="Enter Skill Description">
            </div>
            
            <p class="warning">*Users are required to fill up the form.</p>
            <div class="form-group">
                <button type="submit" class="btn btn-block update-account">Update Skill</button>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="./form_files/jquery-3.2.1.min.js.download"></script>
    <script type="text/javascript" src="./form_files/jquery.mask.min.js.download"></script>
    <script src="./form_files/script.js.download"></script>


</body></html>