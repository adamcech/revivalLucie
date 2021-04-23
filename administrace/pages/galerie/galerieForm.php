<?php

$route = Routes::getRouteByIndex(2);

$gallery = null;
$id = intval($route);

if (ctype_digit($route)) {
    $gallery = (new GalleryMapper())->selectByPk($id);
} else if ($route === "pridat") {
    $gallery = new Gallery();
}

if ($gallery === null) { ?>
    <script type="text/javascript">
        window.location.replace("/administrace/galerie/");
    </script>
<?php }

// FORM
$form = new FormCreator("Galerie", "/administrace/executables/galleryEdit.php", "/administrace/galerie/");

// TAGS
$allTags = (new TagMapper())->selectAll()->results;
$tags = [new FormCreatorSelectOption("[ Žádný ]", "0", $gallery->tag->id === null)];
/** @var Tag $tag */
foreach ($allTags as $tag) {
    $tags[] = new FormCreatorSelectOption($tag->name, $tag->id, $tag->id === $gallery->tag->id);
}
$form->add(new FormCreatorSelect("Tag", "tag", $tags));


// FILE
$form->add(new FormCreatorFileView("member-avatar", "fileId", (new FilesMapper())->selectByPk($gallery->file->id), "Fotka", true));


// HIDDEN
$form->add(new FormCreatorHidden("id", $gallery->id));
$form->add(new FormCreatorHidden("ord", $gallery->ord));

echo $form->generateHtml();
