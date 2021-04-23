<?php

$listCreator = new ListCreator(
    "/administrace/clenove/",
    "Členové",
    new MemberMapper(),
    "ord",
    "/administrace/executables/swapProperty.php",
    "/administrace/executables/removeByPk.php");

echo $listCreator->generateHtml();
