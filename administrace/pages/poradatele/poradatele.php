<?php
// Playlist DB
$listCreator = new ListCreator(
    "/administrace/poradatele/",
    "Playlist",
    new PlaylistMapper(),
    "ord",
    "/administrace/executables/swapProperty.php",
    "/administrace/executables/removeByPk.php");

echo $listCreator->generateHtml();
?>

<hr>

<?php
$configurationMapper = new ConfigurationMapper();

// Playlist File
$playlist = $configurationMapper->getPlaylist();
$playlistForm = new FormCreator("Playlist Soubor", "/administrace/executables/playlistFileEdit.php", null);
$playlistForm->add(new FormCreatorFileView("playlist-file", "fileId", $playlist));
echo $playlistForm->generateHtml();
?>

<hr>

<?php
// Stageplan File
$stageplan = $configurationMapper->getStageplan();
$stageplanForm = new FormCreator("Stageplan Soubor", "/administrace/executables/stageplanFileEdit.php", null);
$stageplanForm->add(new FormCreatorFileView("stageplan-file", "fileId", $stageplan));
echo $stageplanForm->generateHtml();
