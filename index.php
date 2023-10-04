<?php

session_start();
if(isset($_SESSION["uid"]))
{
    echo "<script>window.location.href = 'home/'</script>;";
}
else{
    echo "<script>window.location.href = 'login/'</script>;";
}
exit();

?>