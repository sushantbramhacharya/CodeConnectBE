<?php
session_start();
ob_start();
if(!isset($_SESSION["uid"]))
{
  echo "<script>window.location.href = 'login/'</script>;";
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
  <link rel="stylesheet" href="/code.jquery.com_jquery-3.6.0.min.js" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<?php
    require_once("../components/navbar.php");?>
  <div class="container">
    <?php
    require_once("../components/sidebar.php");
    require_once("../components/posts.php");
    require_once("../components/additional_section.php");
    ?>
    </div>

</body>

</html>
<?php ob_end_flush();?>