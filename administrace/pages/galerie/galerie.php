<?php

$listCreator = new ListImageViewCreator(
    "/administrace/galerie/",
    "Galerie",
    new GalleryMapper(),
    "ord",
    "/administrace/executables/swapProperty.php",
    "/administrace/executables/removeByPk.php");

echo $listCreator->generateHtml();
