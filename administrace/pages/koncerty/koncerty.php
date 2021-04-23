<?php

$listCreator = new ListCreator(
    "/administrace/koncerty/",
    "Koncerty",
    new ConcertMapper(),
    "ord",
    false,
    "/administrace/executables/removeByPk.php");

echo $listCreator->generateHtml();
