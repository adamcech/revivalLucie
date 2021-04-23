<?php

ini_set('session.gc_maxlifetime', 604800);
session_set_cookie_params(604800, "/");
session_start();

if ($_SESSION["a"] === 1) {

    include $_SERVER['DOCUMENT_ROOT']."/php/ModelV2/DatabaseV2Include.php";

    $fileId = intval($_POST["fileId"]);
    (new ConfigurationMapper())->update(ConfigurationProperties::FILES_ID_PLAYLIST, $fileId, '');

    header("Location: /administrace/poradatele/");
}