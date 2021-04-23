<?php

$listCreator = new ListCreator(
    "/administrace/tagy/",
    "Tagy",
    new TagMapper(),
    "ord",
    "/administrace/executables/swapProperty.php",
    "/administrace/executables/removeByPk.php");

echo $listCreator->generateHtml();
