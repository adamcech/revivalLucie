<?php

ini_set('session.gc_maxlifetime', 604800);
session_set_cookie_params(604800, "/");
session_start();

if ($_SESSION["a"] === 1) {

    include $_SERVER['DOCUMENT_ROOT']."/php/ModelV2/DatabaseV2Include.php";

    $id = intval($_POST["id"]);
    $ord = $_POST["ord"];

    $file = new Files();
    $file->id = $_POST["fileId"];

    $tag = new Tag();
    $tag->id = $_POST["tag"];

    $gallery = Gallery::constructWithAllParams($id, $file, $ord, $tag);
    $galleryMapper = new GalleryMapper();

    if ($id === 0) {
        $galleryMapper->insert($gallery);
    } else {
        $galleryMapper->updateByPk($gallery);
    }

    header("Location: /administrace/galerie/");
}