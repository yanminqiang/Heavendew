<?php
    if(!defined("DEW")){
        die("哥，求不黑");
    }
    if(!isset($_SESSION['user_name'])&&!isset($_SESSION['user_status'])){
        header("location:login.php");
    }
?>