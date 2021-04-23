<?php


class Member extends DatabaseV2Entity
{

    /** @var int $id */
    public $id;

    /** @var string $name */
    public $name;

    /** @var string $role */
    public $role;

    /** @var Files $file */
    public $file;

    /** @var int $ord */
    public $ord;

    public function __construct() {
        $this->file = new Files();
    }

    /**
     * @param string $name
     * @param string $role
     * @param Files $file
     * @param int $ord
     * @return Member
     */
    public static function constructWithParams($name, $role, $file, $ord)
    {
        $instance = new Member();

        $instance->name = $name;
        $instance->role = $role;
        $instance->file = $file;
        $instance->ord = $ord;

        return $instance;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $role
     * @param Files $file
     * @param int $ord
     * @return Member
     */
    public static function constructWithAllParams($id, $name, $role, $file, $ord)
    {
        $instance = new Member();

        $instance->id = $id;
        $instance->name = $name;
        $instance->role = $role;
        $instance->file = $file;
        $instance->ord = $ord;

        return $instance;
    }

    public function __toString()
    {
        return $this->name.";  ".$this->role;
    }


    public function getShortName()
    {
        return $this->name;
    }
}