<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/ModelV2/DatabaseV2Include.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/php/FormCreator/FormCreatorInclude.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/php/ListCreator/ListCreatorInclude.php";
?>

<div class="area">
    <?php include $_SERVER['DOCUMENT_ROOT']."/administrace/content.php"; ?>
    <div id="file_picker"></div>
</div>

<nav class="main-menu">
    <ul>
        <li>
            <a href="/administrace/koncerty/">
                <i class="fa fa-music fa-20px"></i>
                <span class="nav-text">
                    Koncerty
                </span>
            </a>
        </li>

        <li>
            <a href="/administrace/clenove/">
                <i class="fa fa-user-circle-o fa-20px"></i>
                <span class="nav-text">
                    Členove
                </span>
            </a>
        </li>

        <li>
            <a href="/administrace/kontakty/">
                <i class="fa fa-phone fa-20px"></i>
                <span class="nav-text">
                    Kontakty
                </span>
            </a>
        </li>

        <li>
            <a href="/administrace/poradatele/">
                <i class="fa fa-list fa-20px"></i>
                <span class="nav-text">
                    Pro Pořadatele
                </span>
            </a>
        </li>

        <li>
            <a href="/administrace/tagy/">
                <i class="fa fa-tag fa-20px"></i>
                <span class="nav-text">
                    Tagy
                </span>
            </a>
        </li>

        <li>
            <a href="/administrace/galerie/">
                <i class="fa fa-picture-o fa-20px"></i>
                <span class="nav-text">
                    Galerie
                </span>
            </a>
        </li>
    </ul>

    <ul class="logout">
        <li>
            <a href="/administrace/soubory/">
                <i class="fa fa-file fa-20px"></i>
                <span class="nav-text">
                    Soubory
                </span>
            </a>
        </li>
        <li>
            <a href="/administrace/pocitadlo/">
                <i class="fa fa-bar-chart fa-20px"></i>
                <span class="nav-text">
                    Počítadlo
                </span>
            </a>
        </li>

        <li>
            <a href="/administrace/odhlaseni/">
                <i class="fa fa-power-off fa-20px"></i>
                <span class="nav-text">
                    Odhlásit se
                </span>
            </a>
        </li>
    </ul>
</nav>
