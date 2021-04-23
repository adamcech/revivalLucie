<?php

include_once $_SERVER['DOCUMENT_ROOT']."/php/Routes.php";

function incl($url) {
    include $_SERVER['DOCUMENT_ROOT'].$url;
}

switch (Routes::getRouteByIndex(0)) {
    case "administrace":    incl("/administrace/index.php"); break;
    default:                incl("/index.php"); break;
}
