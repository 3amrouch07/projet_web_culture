<?php
    include '../../controller/signupartcontroller.php';
    $signupCart=new signupart();
    $signupCart->deletesignupart($_GET["id"]);
    header('Location:listesignupart.php');
?>