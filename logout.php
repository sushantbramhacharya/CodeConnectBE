<?php
session_start();
if(isset($_SESSION["uid"]))
{
    session_unset();
    session_destroy();
}
header("Location: login/");
exit();

?>