<?php

ini_set('session.gc_maxlifetime', 604800);
session_set_cookie_params(604800, "/");
session_start();

if ($_SESSION["a"] === 1) {

    include $_SERVER['DOCUMENT_ROOT']."/php/ModelV2/DatabaseV2Include.php";

    $id = intval($_POST["id"]);
    $date = $_POST["date"];
    $name = $_POST["name"];
    $place = $_POST["place"];

    $concert = Concert::constructWithAllParams($id, $date, $name, $place);
    $concertMapper = new ConcertMapper();

    if ($id === 0) {
        $concertMapper->insert($concert);
    } else {
        $concertMapper->updateByPk($concert);
    }

    header("Location: /administrace/koncerty/");
}