<?php

ini_set('session.gc_maxlifetime', 604800);
session_set_cookie_params(604800, "/");
session_start();

if ($_SESSION["a"] === 1) {

    include $_SERVER['DOCUMENT_ROOT']."/php/ModelV2/DatabaseV2Include.php";;

    $id = intval($_POST["id"]);
    $ord = intval($_POST["ord"]);
    $name = $_POST["name"];
    $role = $_POST["role"];

    $file = new Files();
    $file->id = intval($_POST["fileId"]);

    $member = Member::constructWithAllParams($id, $name, $role, $file, $ord);
    $memberMapper = new MemberMapper();

    if ($id === 0) {
        $memberMapper->insert($member);
    } else {
        $memberMapper->updateByPk($member);
    }

    header("Location: /administrace/clenove/");
}