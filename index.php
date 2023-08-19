<?php

session_start();
if(isset($_SESSION["uid"]))
{
    header("Location: home/");
}
else{
    header("Location: login/");
}
exit();

?>