<?php

$route = Routes::getRouteByIndex(2);

$member = null;
$id = intval($route);

if (ctype_digit($route)) {
    $member = (new MemberMapper())->selectByPk($id);
} else if ($route === "pridat") {
    $member = new Member();
}

if ($member === null) { ?>
    <script type="text/javascript">
        window.location.replace("/administrace/clenove/");
    </script>
<?php }

$form = new FormCreator("Kontakty", "/administrace/executables/memberEdit.php", "/administrace/clenove/");

$form->add(new FormCreatorText("Jméno", "name", $member->name));
$form->add(new FormCreatorText("Nástroj", "role", $member->role));
$form->add(new FormCreatorFileView("member-avatar", "fileId", (new FilesMapper())->selectByPk($member->file->id), "Fotka", true));


$form->add(new FormCreatorHidden("id", $member->id));
$form->add(new FormCreatorHidden("ord", $member->ord));

echo $form->generateHtml();
