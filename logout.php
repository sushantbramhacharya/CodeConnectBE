<?php
session_start();
if(isset($_SESSION["uid"]))
{
    session_unset();
    session_destroy();
}
echo "<script>window.location.href = 'login/'</script>;";
exit();

?>