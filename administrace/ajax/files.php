<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/php/ModelV2/DatabaseV2Include.php";

$type = $_POST['type'];
$from = $_POST['from'];
$limit = $_POST['limit'];
$query = $_POST['query'];

$response = null;
$filesMapper = new FilesMapper();

switch ($type) {
    case "rowCount":
        $response = $filesMapper->countAllRows();
        break;

    case "search":
        $response = $filesMapper->search($query, $limit)->results;
        break;

    case "searchImages":
        $response = $filesMapper->search($query, $limit, true)->results;
        break;

    case "selectLimit":
        $response = $filesMapper->selectLimit($from, $limit)->results;
        break;
}

echo json_encode($response);