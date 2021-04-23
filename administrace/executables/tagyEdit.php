<?php

ini_set('session.gc_maxlifetime', 604800);
session_set_cookie_params(604800, "/");
session_start();

if ($_SESSION["a"] === 1) {

    include $_SERVER['DOCUMENT_ROOT']."/php/ModelV2/DatabaseV2Include.php";

    $id = intval($_POST["id"]);
    $name = $_POST["name"];
    $ord = $_POST["ord"];

    $concert = Tag::constructWithAllParams($id, $name, $ord);
    $tagMapper = new TagMapper();

    if ($id === 0) {
        $tagMapper->insert($concert);
    } else {
        $tagMapper->updateByPk($concert);
    }

    header("Location: /administrace/tagy/");
}