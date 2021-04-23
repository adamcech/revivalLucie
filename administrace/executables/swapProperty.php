<?php

ini_set('session.gc_maxlifetime', 604800);
session_set_cookie_params(604800, "/");
session_start();

if ($_SESSION["a"] === 1) {

    include $_SERVER['DOCUMENT_ROOT'] . "/php/ModelV2/DatabaseV2Include.php";

    $id_0 = $_POST["id0"];
    $id_1 = $_POST["id1"];
    $property = $_POST["property"];
    $tableName = $_POST["tableName"];

    $mapper = DatabaseV2::getMapperByTableName($tableName);
    $mapper->swapPropertyByPk($id_0, $id_1, $property);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}