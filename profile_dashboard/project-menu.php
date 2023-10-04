<?php
session_start();?>
<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Projects</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<?php
require_once("../db_connect.php");
$uid = $_SESSION["uid"];
$query="SELECT name,pid FROM projects WHERE uid = $uid LIMIT 5;";
$result=mysqli_query($conn,$query);
$projects=array();
while($row=$result->fetch_assoc())
{
    $projects[]=array(
        "name"=>$row['name'],
        "pid"=>$row['pid']
    );
}
?>
<body>
    <div class="update-profile">
        <form>
            
            <div class="form-icon">
                <span><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512" fill="white"><path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"/></svg></span>
            </div>
            <div class="form-group">
            </div>
            <p class="warning">*Add Projects</p>
            <?php
            foreach($projects as $project)
            {
            ?>
            <div class="form-group">
                <a type="button" href="manage_project.php/?project_id=<?php echo $project['pid'];?>" class="btn btn-block update-account"><?php echo $project['name'];?></a>
            </div>
            <?php
            }
            ?>
            <div class="form-group">
                <a type="button" href="add_project.php" class="btn btn-block update-account">Add Project</a>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="./The Easiest Way to Add Input Masks to Your Forms_files/jquery-3.2.1.min.js.download"></script>
    <script type="text/javascript" src="./The Easiest Way to Add Input Masks to Your Forms_files/jquery.mask.min.js.download"></script>
    <script src="./The Easiest Way to Add Input Masks to Your Forms_files/script.js.download"></script>


</body></html> 