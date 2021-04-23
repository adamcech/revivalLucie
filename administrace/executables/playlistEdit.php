<?php

ini_set('session.gc_maxlifetime', 604800);
session_set_cookie_params(604800, "/");
session_start();

if ($_SESSION["a"] === 1) {

    include $_SERVER['DOCUMENT_ROOT']."/php/ModelV2/DatabaseV2Include.php";

    $id = intval($_POST["id"]);
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $ord = intval($_POST["ord"]);

    $playlist = Playlist::constructWithAllParams($id, $name, $comment, $ord);
    $playlistMapper = new PlaylistMapper();

    if ($id === 0) {
        $playlistMapper->insert($playlist);
    } else {
        $playlistMapper->updateByPk($playlist);
    }

    header("Location: /administrace/poradatele/");
}