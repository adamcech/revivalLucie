<?php


class Playlist extends DatabaseV2Entity
{
    /** @var int $id */
    public $id;

    /** @var string $name */
    public $name;

    /** @var string $comment */
    public $comment;

    /** @var int $int */
    public $ord;

    public function __construct() { }

    /**
     * @param string $name YYYY-MM-DD
     * @param string $comment
     * @param string $ord
     * @return Playlist
     */
    public static function constructWithParams($name, $comment, $ord)
    {
        $instance = new Playlist();

        $instance->name = $name;
        $instance->comment = $comment;
        $instance->ord = $ord;

        return $instance;
    }

    /**
     * @param int $id
     * @param string $name YYYY-MM-DD
     * @param string $comment
     * @param string $ord
     * @return Playlist
     */
    public static function constructWithAllParams($id, $name, $comment, $ord)
    {
        $instance = new Playlist();

        $instance->id = $id;
        $instance->name = $name;
        $instance->comment = $comment;
        $instance->ord = $ord;

        return $instance;
    }

    public function __toString()
    {
        return $this->getShortName();
    }

    public function getShortName()
    {
        return $this->name;
    }
}