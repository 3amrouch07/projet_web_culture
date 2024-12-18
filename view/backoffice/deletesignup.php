<?php
    include '../../controller/signupcontroller.php';
    $signupC=new signup();
    $signupC->deletesignup($_GET["id"]);
    header('Location:listesignup.php');
?>