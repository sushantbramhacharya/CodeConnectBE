<?php
session_start();?>
<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Certification</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<?php
require_once("../db_connect.php");
if($_SERVER['REQUEST_METHOD']==="POST")
{
    if(!empty($_POST['certification-title'])&&isset($_SESSION))
    {
        $uid = $_SESSION["uid"];
        $name = $_POST["certification-title"];
        $cert_id=$_POST["cert_id"];
        $query="UPDATE certifications SET name='$name'  WHERE uid=$uid AND cert_id=$cert_id";
        $result=mysqli_query($conn,$query);
    }
    if (isset($_FILES["certification-photo"]) && $_FILES["certification-photo"]["error"] === 0 ) {
        $cert_id=$_POST["cert_id"]."";
        $targetDirectory = "../uploads/certifications/"; 
        if (!is_numeric($cert_id)) {
            echo "Invalid UID.";
            exit;
        }

        $newFileName = $cert_id . ".png";
        $targetFile = $targetDirectory . $newFileName;

        if (file_exists($targetFile)) {
            // Delete the existing file
            unlink($targetFile);
        }
        move_uploaded_file($_FILES["certification-photo"]["tmp_name"], $targetFile);
        require_once("./profile_server_scripts/success.php");
        exit();

    }
}
if($_SERVER['REQUEST_METHOD']==="POST"&&isset($_SESSION)){
    require_once("./profile_server_scripts/success.php");
    exit();
}
?>

<body>
    <div class="update-profile">
        <form method="POST" action="manage-certifications.php" enctype="multipart/form-data">
        <input type="hidden" name="cert_id" value="<?php echo $_GET['cert_id']?>">
            <div class="form-icon">
                <span><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="white"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M211 7.3C205 1 196-1.4 187.6 .8s-14.9 8.9-17.1 17.3L154.7 80.6l-62-17.5c-8.4-2.4-17.4 0-23.5 6.1s-8.5 15.1-6.1 23.5l17.5 62L18.1 170.6c-8.4 2.1-15 8.7-17.3 17.1S1 205 7.3 211l46.2 45L7.3 301C1 307-1.4 316 .8 324.4s8.9 14.9 17.3 17.1l62.5 15.8-17.5 62c-2.4 8.4 0 17.4 6.1 23.5s15.1 8.5 23.5 6.1l62-17.5 15.8 62.5c2.1 8.4 8.7 15 17.1 17.3s17.3-.2 23.4-6.4l45-46.2 45 46.2c6.1 6.2 15 8.7 23.4 6.4s14.9-8.9 17.1-17.3l15.8-62.5 62 17.5c8.4 2.4 17.4 0 23.5-6.1s8.5-15.1 6.1-23.5l-17.5-62 62.5-15.8c8.4-2.1 15-8.7 17.3-17.1s-.2-17.3-6.4-23.4l-46.2-45 46.2-45c6.2-6.1 8.7-15 6.4-23.4s-8.9-14.9-17.3-17.1l-62.5-15.8 17.5-62c2.4-8.4 0-17.4-6.1-23.5s-15.1-8.5-23.5-6.1l-62 17.5L341.4 18.1c-2.1-8.4-8.7-15-17.1-17.3S307 1 301 7.3L256 53.5 211 7.3z"/></svg></span>
            </div>

            <div class="form-group">
                <label for="upload-certification-photo">Choose a Photo</label>
                <input type="file" class="form-control item" id="certification-photo" name="certification-photo">
              </div>
            
            <div class="form-group">
                <input type="text" class="form-control item" id="certification-title" name="certification-title" placeholder="Enter The Title Of Certification">
            </div>
            <p class="warning">* Empty fields wont be updated.</p>
            <div class="form-group">
                <button type="submit" class="btn btn-block update-account">Update Certification</button>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="./form_files/jquery-3.2.1.min.js.download"></script>
    <script type="text/javascript" src="./form_files/jquery.mask.min.js.download"></script>
    <script src="./form_files/script.js.download"></script>


</body></html>