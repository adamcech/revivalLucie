<?php

class Files extends DatabaseV2Entity {

    public $id;
    public $name;
    public $idName;
    public $type;
    public $shortcut;

    public $container;

    public function __construct() { }

    public static function constructWithParams($name, $idName, $type, $shortcut) {
        $instance = new Files();

        $instance->name = $name;
        $instance->idName = $idName;
        $instance->type = $type;
        $instance->shortcut = $shortcut;

        return $instance;
    }

    public static function constructWithAllParams($id, $name, $idName, $type, $shortcut) {
        $instance = new Files();

        $instance->id = $id;
        $instance->name = $name;
        $instance->idName = $idName;
        $instance->type = $type;
        $instance->shortcut = $shortcut;

        return $instance;
    }

    /**
     * @return bool
     */
    public function isImage() {
        return $this->shortcut == "jpg" || $this->shortcut == "jpeg" || $this->shortcut == "gif" || $this->shortcut == "png";
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->getShortName();
    }

    /**
     * @return string
     */
    public function getShortName() {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function hasValidLink() {
        return $this->idName !== null;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->hasValidLink() ? "/files/".$this->idName : "#";
    }

    public function getAdminLink()
    {
        return $this->hasValidLink() ? "/administrace/soubory/".$this->id."/" : "#";
    }
}