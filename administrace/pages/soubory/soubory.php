<h1>Soubory</h1>

<p class="red">
    Při nahrávání velkého množství dat (souborů) nebo v případě pomalého připojení,
    může dojít k přerušení ze strany webhostingu. <br>
    V případě že se soubory nenahrají je potřeba nahrát je postupně v menším množství.
<p>

<?php
    if (isset($_GET["e"]))
    {
        $e = intval($_GET["e"]);

        $err = "<div class='err_message'>";

        switch ($e)
        {
            case 1: case 2:
                $err .= "Velikost souboru přesahuje povolenou velikost webhostingu, je nutné soubor zmenšit";
                break;

            case 3:
                $err .= "Došlo k chybě připojení, zkuste soubor nahrát znovu.";
                break;

            case 4:
                $err .= "Nebyly nahrány žádné soubory!";
                break;

            case 6: case 7:
                $err .= "Došlo k chybě webhostingu, zkuste soubor nahrát později.";
                break;

            case 8:
                $err .= "Je možné nahrávat pouze soubory typu \".jpg\", \".png\", \".pdf\"!";
                break;
        }

        $err .= "</div>";
        echo $err;
    }
?>

<form method="POST" enctype="multipart/form-data" action="/administrace/executables/uploadFile.php" accept-charset="UTF-8">
    <input multiple="" type="file" name="files[]"/>
    <input class="vyhledavac-odeslat" type="submit" value="Nahrát"/>

    <input id="disable_search" class="red_submit" type="button" value="Zrušit vyhledávání"/>
</form>

<div class="prod_head_filter">
    <input id="prod_search" type="text"/>
    <input id="prod_search_button" type="button" value="Hledat soubory"/>
</div>

<div id="files_table"></div>

<div class="bottom-pages"></div>

<script type="text/javascript" src="/administrace/js/files.js"></script>