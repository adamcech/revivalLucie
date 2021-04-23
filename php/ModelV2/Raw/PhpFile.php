<?php

class PhpFile
{
    public $name;
    public $type;
    public $tmpName;
    public $error;
    public $size;
    public $id;

    public function __construct($name, $type, $tmpName, $error, $size)
    {
        $this->name = DatabaseV2Entity::remove_accents($name);
        $this->type = $type;
        $this->tmpName = $tmpName;
        $this->error = $error;
        $this->size = $size;

        $this->id = null;
    }

    public function save()
    {
        $filesMapper = new FilesMapper();

        $file = Files::constructWithParams($this->name, "", $this->type, getShortcut($this->name));

        $file->id = $filesMapper->insert($file)->lastInsertId;
        $file->container = (new ConfigurationMapper())->getFileContainer();
        $file->idName = $file->container."/".$file->id.".".$file->shortcut;
        $filesMapper->updateByPk($file);


        if (!is_dir($_SERVER['DOCUMENT_ROOT']."/files")) { mkdir($_SERVER['DOCUMENT_ROOT']."/files"); }
        if (!is_dir($_SERVER['DOCUMENT_ROOT']."/files/mini")) { mkdir($_SERVER['DOCUMENT_ROOT']."/files/mini"); }

        if (!is_dir($_SERVER['DOCUMENT_ROOT']."/files/$file->container")) { mkdir($_SERVER['DOCUMENT_ROOT']."/files/$file->container"); }
        $targetFile = $_SERVER['DOCUMENT_ROOT']."/files/".$file->idName;

        if (!move_uploaded_file($this->tmpName, $targetFile))
        {
            echo "Doslo k chybe behem ukladani, zkuste znovu.";
        }

        if (exif_imagetype($targetFile) == IMAGETYPE_JPEG || exif_imagetype($targetFile) == IMAGETYPE_PNG)
        {
            if (!is_dir($_SERVER['DOCUMENT_ROOT']."/files/mini/$file->container")) { mkdir($_SERVER['DOCUMENT_ROOT']."/files/mini/$file->container"); }

            $target_thumb_file = $_SERVER['DOCUMENT_ROOT']."/files/mini/$file->idName";
            makeThumb($targetFile, $target_thumb_file, 300);
        }

        PhpFile::addUpload();
    }

    public static function addUpload()
    {
        $configurationMapper = new ConfigurationMapper();
        $configurationMapper->increaseProperty(ConfigurationProperties::UPLOAD_COUNTER);

        $uploadCounter = $configurationMapper->getUploadCounter();

        if (intval($uploadCounter) >= 3000)
        {
            $configurationMapper->update(ConfigurationProperties::UPLOAD_COUNTER, 0, '');
            $configurationMapper->increaseProperty(ConfigurationProperties::FILE_CONTAINER);
         }

        return true;
    }

}
