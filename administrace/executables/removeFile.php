<?php

ini_set('session.gc_maxlifetime', 604800);
session_set_cookie_params(604800, "/");
session_start();

if ($_SESSION["a"] === 1) {

    include $_SERVER['DOCUMENT_ROOT']."/php/ModelV2/DatabaseV2Include.php";

    $id = $_POST["id"];

    (new FilesMapper())->deleteByPk($id);

    header("Location: /administrace/soubory/");
}