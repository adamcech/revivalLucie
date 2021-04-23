<?php

$route = Routes::getRouteByIndex(2);

$contact = null;
$id = intval($route);

if (ctype_digit($route)) {
    $contact = (new ContactMapper())->selectByPk($id);
} else if ($route === "pridat") {
    $contact = new Contact();
}

if ($contact === null) { ?>
    <script type="text/javascript">
        window.location.replace("/administrace/kontakty/");
    </script>
<?php }

$form = new FormCreator("Kontakty", "/administrace/executables/contactEdit.php", "/administrace/kontakty/");

$form->add(new FormCreatorText("Název", "name", $contact->name));
$form->add(new FormCreatorText("Email", "email", $contact->email));
$form->add(new FormCreatorText("Telefon", "phone", $contact->phone, "Ve formátu: \"123 456 789\""));

$form->add(new FormCreatorHidden("id", $contact->id));
$form->add(new FormCreatorHidden("ord", $contact->ord));

echo $form->generateHtml();
