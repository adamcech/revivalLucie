<?php

$route = Routes::getRouteByIndex(2);

$playlist = null;
$id = intval($route);

if (ctype_digit($route)) {
    $playlist = (new PlaylistMapper())->selectByPk($id);
} else if ($route === "pridat") {
    $playlist = new Playlist();
}

if ($playlist === null) { ?>
    <script type="text/javascript">
        window.location.replace("/administrace/poradatele/");
    </script>
<?php }

$form = new FormCreator("Playlist", "/administrace/executables/playlistEdit.php", "/administrace/poradatele/");

$form->add(new FormCreatorText("Název", "name", $playlist->name));
$form->add(new FormCreatorText("Popis", "comment", $playlist->comment));

$form->add(new FormCreatorHidden("id", $playlist->id));
$form->add(new FormCreatorHidden("ord", $playlist->ord));

echo $form->generateHtml();
