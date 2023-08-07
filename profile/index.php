<?php
ob_start();
session_start();
if(!isset($_SESSION["uid"]))
{
    header("Location: ../login/");
    exit();
}

require_once("../db_connect.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="../home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<?php
    require_once("../components/navbar.php");?>
  <div class="container">
    <?php
    require_once("../components/sidebar.php");
    require_once("../components/profile_post.php");
    require_once("../components/additional_section.php");
    ?>
    </div>

</body>

</html>
<?php ob_end_flush();?>