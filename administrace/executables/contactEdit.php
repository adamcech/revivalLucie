<?php

ini_set('session.gc_maxlifetime', 604800);
session_set_cookie_params(604800, "/");
session_start();

if ($_SESSION["a"] === 1) {

    include $_SERVER['DOCUMENT_ROOT']."/php/ModelV2/DatabaseV2Include.php";

    $id = intval($_POST["id"]);
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $ord = intval($_POST["ord"]);

    $contact = Contact::constructWithAllParams($id, $name, $phone, $email, $ord);
    $contactMapper = new ContactMapper();

    if ($id === 0) {
        $contactMapper->insert($contact);
    } else {
        $contactMapper->updateByPk($contact);
    }

    header("Location: /administrace/kontakty/");
}