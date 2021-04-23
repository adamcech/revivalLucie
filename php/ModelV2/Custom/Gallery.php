<?php


class Gallery extends DatabaseV2Entity
{

    /** @var int $id */
    public $id;

    /** @var Files $file */
    public $file;

    /** @var int $ord */
    public $ord;

    /** @var Tag $tag */
    public $tag;

    public function __construct() {
        $this->file = new Files();
        $this->tag = new Tag();
    }

    /**
     * @param Files $file
     * @param int $ord
     * @param Tag $tag
     * @return Gallery
     */
    public static function constructWithParams($file, $ord, $tag)
    {
        $instance = new Gallery();

        $instance->file = $file;
        $instance->ord = $ord;
        $instance->tag = $tag;

        return $instance;
    }

    /**
     * @param int $id
     * @param Files $file
     * @param int $ord
     * @param Tag
     * $tag
     * @return Gallery
     */
    public static function constructWithAllParams($id, $file, $ord, $tag)
    {
        $instance = new Gallery();

        $instance->id = $id;
        $instance->file = $file;
        $instance->ord = $ord;
        $instance->tag = $tag;

        return $instance;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getShortName();
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        $photoName = "";
        if ($this->file->id === null) {
            $photoName .= "Bez fotky (Smazána)";
        } else {
            $photoName .= $this->file->name;
        }

        if ($this->tag->id === null) {
            return $photoName;
        } else {
            return $this->tag->name." - ".$photoName;
        }
    }

    /**
     * @return string
     */
    public function getPathToImage()
    {
        return "/files/".$this->file->idName;
    }

    /**
     * @return string
     */
    public function getPathToImageThumb()
    {
        return "/files/mini/".$this->file->idName;
    }
}