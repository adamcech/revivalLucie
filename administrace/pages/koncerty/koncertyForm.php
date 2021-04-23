<?php

$route = Routes::getRouteByIndex(2);

$concert = null;
$id = intval($route);

if (ctype_digit($route)) {
    $concert = (new ConcertMapper())->selectByPk($id);
} else if ($route === "pridat") {
    $concert = new Concert();
}

if ($concert === null) { ?>
    <script type="text/javascript">
        window.location.replace("/administrace/koncerty/");
    </script>
<?php }

$form = new FormCreator("Koncerty", "/administrace/executables/concertEdit.php", "/administrace/koncerty/");

$form->add(new FormCreatorText("Název", "name", $concert->name));
$form->add(new FormCreatorText("Místo", "place", $concert->place));
$form->add(new FormCreatorDate("Datum", "date", $concert->date));

$form->add(new FormCreatorHidden("id", $concert->id));

echo $form->generateHtml();
