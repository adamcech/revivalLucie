<?php
$id = Routes::getRouteByIndex(2);

/** @var files $file */
$file = (new FilesMapper())->selectByPk($id);
?>

<h1>Soubory</h1>

<div class="top_buttons_table">
    <div class="top_buttons_row">

        <div class="top_buttons_left">
            <a id="link_save_file_form" class="a-button">Uložit</a>
            <a class="a-button red-button" href="/administrace/soubory/">Zpět</a>
        </div>

        <div class="top_buttons_right">

            <form method="POST" action="/administrace/executables/removeFile.php" accept-charset="UTF-8">
                <input type="hidden" name="id" value="<?php echo $file->id; ?>">
                <input class="red_submit" type="submit" value="Odstranit">
            </form>

        </div>

    </div>
</div>

<form id="file_form" method="POST" action="/administrace/executables/fileEdit.php" accept-charset="UTF-8">
    <input type="hidden" name="id" value="<?php echo $file->id; ?>">
    <div class="table">


        <div class="tr">
            <div class="td middle input-label">Odkaz: </div>
            <div class="td"><a target="_blank" href="https://revivallucie.cz/files/<?php echo $file->idName; ?>">https://revivallucie.cz/files/<?php echo $file->idName; ?></a></div>
        </div>


        <div class="tr">
            <div class="td middle input-label">Název: </div>
            <div class="td">
                <input type="text" name="name" value="<?php echo $file->name; ?>">
            </div>
        </div>
    </div>
</form>

<?php if ($file->isImage()) { ?>
    <div class="file_container">
        <img alt="<?php echo $file->name; ?>" src="/files/<?php echo $file->idName; ?>"/>
    </div>
<?php } ?>

<script type="text/javascript">
    $(document).on("click", "#link_save_file_form", function(event)
    {
        $("#file_form").submit();
    });
</script>