<?php
session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update CV</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<?php
require_once("../db_connect.php");
if(isset($_SESSION))
{
    $uid = $_SESSION["uid"].""; 
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Check if a file was uploaded without errors
        if (isset($_FILES["cv"]) && $_FILES["cv"]["error"] === 0) {
            $targetDirectory = "../uploads/cv/"; // Create a directory to store uploads
    
            // Ensure the $uid is valid (e.g., sanitize it to prevent security issues)
            // Here, we're assuming it's a numeric value.
            if (!is_numeric($uid)) {
                echo "Invalid UID.";
                exit;
            }
    
            // Construct the new file name as "$uid.jpg"
            $newFileName = $uid . ".pdf";
            $targetFile = $targetDirectory . $newFileName;

            if (file_exists($targetFile)) {
                // Delete the existing file
                unlink($targetFile);
            }
    
            // Move the uploaded file to the desired directory with the new name
            if (move_uploaded_file($_FILES["cv"]["tmp_name"], $targetFile)) {
                require_once("./profile_server_scripts/success.php");
                exit();
            } else {
                // echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

?>
<body>
    <div class="update-profile">
        <form method="POST" accept="update_cv.php" enctype="multipart/form-data">
            
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
            <label class="form-label" for="customFile">Choose File</label>
            <input type="file" class="form-control" id="customFile" name="cv" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block update-account">Update CV</button>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
