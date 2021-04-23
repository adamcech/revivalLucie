<?php

$route = Routes::getRouteByIndex(2);

$tag = null;
$id = intval($route);

if (ctype_digit($route)) {
    $tag = (new TagMapper())->selectByPk($id);
} else if ($route === "pridat") {
    $tag = new Tag();
}

if ($tag === null) { ?>
    <script type="text/javascript">
        window.location.replace("/administrace/tagy/");
    </script>
<?php }

$form = new FormCreator("Tagy", "/administrace/executables/tagyEdit.php", "/administrace/tagy/");

$form->add(new FormCreatorText("Název", "name", $tag->name));
$form->add(new FormCreatorHidden("id", $tag->id));
$form->add(new FormCreatorHidden("ord", $tag->ord));

echo $form->generateHtml();
