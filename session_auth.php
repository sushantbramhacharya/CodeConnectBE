<?php
if(isset($_SESSION["uid"]))
{
    echo "<script>window.location.href = '../home/'</script>;";

    exit();
}
?>