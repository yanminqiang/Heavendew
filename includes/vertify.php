<?php
    if(!defined("DEW")){
        die("哥，求不黑");
    }
    if(!isset($_SESSION['terminal_username'])&&!isset($_SESSION['terminal_id'])
        ||!isset($_SESSION['distributor_username'])&&!isset($_SESSION['distributor_id'])){
        header("location:login.php");
    }
?>