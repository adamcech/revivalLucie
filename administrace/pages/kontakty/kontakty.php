<?php

$listCreator = new ListCreator(
    "/administrace/kontakty/",
    "Kontakty",
    new ContactMapper(),
    "ord",
    "/administrace/executables/swapProperty.php",
    "/administrace/executables/removeByPk.php");

echo $listCreator->generateHtml();
