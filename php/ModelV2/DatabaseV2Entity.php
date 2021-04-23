<?php

abstract class DatabaseV2Entity {

    /** @return DatabaseV2Entity */
    public function copy() {
        $className = get_class($this);
        $instance = new $className();

        foreach (array_keys(get_object_vars($this)) as $var) {
            $instance->{$var} = $this->{$var};
        }

        return $instance;
    }

    /**
     * @return string
     */
    public abstract function getShortName();

    /**
     * @return string
     */
    public function getPathToImage() {
        return null;
    }

    /**
     * @return string
     */
    public function getPathToImageThumb() {
        return null;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $str = "";

        foreach (array_keys(get_object_vars($this)) as $var) {
            $str .= "$var: ".$this->{$var}."; ";
        }

        return $str;
    }

    /**
     * @param string $str
     * @return string
     */
    public static function remove_accents($str)
    {
        $diacritic = array("í", "ě", "š", "č", "ř", "ž", "ý", "á", "ň", "é", "ů", "ú", "ó", "ď", "ť");
        $diacritic_replace = array("i", "e", "s", "c", "r", "z", "y", "a", "n", "e", "u", "u", "o", "d", "t");

        return str_replace($diacritic, $diacritic_replace, mb_strtolower($str, 'UTF-8'));
    }
}
