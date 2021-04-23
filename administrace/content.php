<?php

function _404() {
    incl("/administrace/pages/404.php");
}

$routes = Routes::getRoutes()->routes;

switch ($routes[1]) {

    case "": incl("/administrace/pages/pocitadlo.php"); break;

    case "poradatele":
        switch ($routes[2]) {
            case "":                                                incl("/administrace/pages/poradatele/poradatele.php"); break;
            case $routes[2] == "pridat" || ctype_digit($routes[2]): incl("/administrace/pages/poradatele/poradateleForm.php"); break;
            default:                                                _404(); break;
        } break;

    case "galerie":
        switch ($routes[2]) {
            case "":                                                incl("/administrace/pages/galerie/galerie.php"); break;
            case $routes[2] == "pridat" || ctype_digit($routes[2]): incl("/administrace/pages/galerie/galerieForm.php"); break;
            default:                                                _404(); break;
        } break;

    case "tagy":
        switch ($routes[2]) {
            case "":                                                incl("/administrace/pages/tagy/tagy.php"); break;
            case $routes[2] == "pridat" || ctype_digit($routes[2]): incl("/administrace/pages/tagy/tagyForm.php"); break;
            default:                                                _404(); break;
        } break;

    case "kontakty":
        switch ($routes[2]) {
            case "":                                                incl("/administrace/pages/kontakty/kontakty.php"); break;
            case $routes[2] == "pridat" || ctype_digit($routes[2]): incl("/administrace/pages/kontakty/kontaktyForm.php"); break;
            default:                                                _404(); break;
        } break;

    case "clenove":
        switch ($routes[2]) {
            case "":                                                incl("/administrace/pages/clenove/clenove.php"); break;
            case $routes[2] == "pridat" || ctype_digit($routes[2]): incl("/administrace/pages/clenove/clenoveForm.php"); break;
            default:                                                _404(); break;
        } break;

    case "koncerty":
        switch ($routes[2]) {
            case "":                                                incl("/administrace/pages/koncerty/koncerty.php"); break;
            case $routes[2] == "pridat" || ctype_digit($routes[2]): incl("/administrace/pages/koncerty/koncertyForm.php"); break;
            default:                                                _404(); break;
        } break;

    case "soubory":
        switch ($routes[2]) {
            case "":                        incl("/administrace/pages/soubory/soubory.php"); break;
            case ctype_digit($routes[2]):   incl("/administrace/pages/soubory/souboryForm.php"); break;
            default:                        _404(); break;
        } break;

    case "pocitadlo":   incl("/administrace/pages/pocitadlo.php"); break;
    case "odhlaseni":   incl("/administrace/pages/odhlaseni.php"); break;
    default:            _404(); break;
}
