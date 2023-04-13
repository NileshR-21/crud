<?php
session_start();
session_unset();
session_destroy();
header("location:login.php");

?>

<!-- <h1>Logged Out Successfully</h1>
<style>
    h1{
        text-align: center;
    }
</style> -->