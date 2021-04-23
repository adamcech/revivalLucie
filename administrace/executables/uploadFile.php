<?php

function exit_err($code)
{
    if (isset($_POST["type"])) {
        if ($_POST["type"] == "ajax") {
            echo $code;
            exit;
        }
    }

    header("Location: /administrace/soubory/?e=$code");
    exit;
}

ini_set('session.gc_maxlifetime', 604800);
session_set_cookie_params(604800, "/");
session_start();

if ($_SESSION["a"] === 1) {
    include_once $_SERVER['DOCUMENT_ROOT']."/php/tools.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/php/ModelV2/DatabaseV2Include.php";

    $err = false;
    $errMessage = [];

    /** @var PhpFile[] $files */
    $files = [];

    $fromAjax = false;
    if (isset($_POST["type"])) {
        if ($_POST["type"] == "ajax") {
            $fromAjax = true;

            $files[] = new PhpFile($_FILES["files"]["name"], $_FILES["files"]["type"], $_FILES["files"]["tmp_name"],
                $_FILES["files"]["error"], $_FILES["files"]["size"]);
        }
    }

    if (!$fromAjax) {
        for ($i = 0; $i < count($_FILES["files"]["name"]); $i++) {
            $files[] = new PhpFile($_FILES["files"]["name"][$i], $_FILES["files"]["type"][$i],
                $_FILES["files"]["tmp_name"][$i], $_FILES["files"]["error"][$i], $_FILES["files"]["size"][$i]);
        }
    }

    /** @var PhpFile $file */
    foreach ($files as $file) {
        if ($file->error > 0) {
            exit_err($file->error);
        }

        if ( !($file->type == "image/jpeg" || $file->type == "image/png" || $file->type == "application/pdf") )
        {
            exit_err(8);
        }
    }

    foreach ($files as $file) {
        $file->save();
    }
}

if (isset($_POST["type"])) {
    if ($_POST["type"] == "ajax") {
        echo "0";
        exit;
    }
}

header("Location: /administrace/soubory/");
exit;