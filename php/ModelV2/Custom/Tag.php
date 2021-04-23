<?php


class Tag extends DatabaseV2Entity
{

    /** @var int $id */
    public $id;

    /** @var string $name */
    public $name;

    /** @var int $ord */
    public $ord;

    public function __construct() { }

    /**
     * @param string $name
     * @param int $ord
     * @return Tag
     */
    public static function constructWithParams($name, $ord)
    {
        $instance = new Tag();
        $instance->name = $name;
        $instance->ord = $ord;

        return $instance;
    }

    /**
     * @param int $id
     * @param string $name
     * @param int $ord
     * @return Tag
     */
    public static function constructWithAllParams($id, $name, $ord)
    {
        $instance = new Tag();

        $instance->id = $id;
        $instance->name = $name;
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