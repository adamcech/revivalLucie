<?php

session_start();
include $_SERVER['DOCUMENT_ROOT']."/php/Config.php";
$config = Config::getConfig();

$l = $_POST['l'];
$p = $_POST['p'];

$_SESSION["a"] = 0;

if ($l == $config->adminLogin && $p == $config->adminPassword)
{
    $_SESSION["a"] = 1;
    header("Location: /administrace/");
}
else
{
    $_SESSION["login_err"] = 1;
    header("Location: ".$_SERVER['HTTP_REFERER']);
}
