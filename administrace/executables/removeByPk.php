<?php

ini_set('session.gc_maxlifetime', 604800);
session_set_cookie_params(604800, "/");
session_start();

if ($_SESSION["a"] === 1) {

    include $_SERVER['DOCUMENT_ROOT']."/php/ModelV2/DatabaseV2Include.php";

    $id = $_POST["id"];
    $table_name = $_POST["tableName"];

    $mapper = DatabaseV2::getMapperByTableName($table_name);
    $mapper->deleteByPk($id);

    header('Location: '.$_SERVER['HTTP_REFERER']);

}