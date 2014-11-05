<?php
    if(!defined('DEW')){
        die("帅哥，求不黑！");
    }
    include 'includes/config.php';
    include 'includes/lib_mysql.php';
    /*加载smarty所需文件*/
    $db = new lib_mysql($db_host, $db_user, $db_pass, $db_name);
    $db_host=$db_user=$db_pass=$db_name=NULL;
    /*初始化smarty对象*/
    include 'includes/Smarty.class.php';
    $smarty=new Smarty();
    $smarty->template_dir="templates";
    $smarty->compile_dir="compile";
    $smarty->config_dir="config";
    $smarty->cache_dir="caches";
    session_start();
?>