<?php
    session_start();
    session_unset();
    session_destroy();
 
    $url = "signin.php";
    echo "<script>window.location.replace('$url');</script>";

    ?>