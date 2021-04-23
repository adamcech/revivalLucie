<?php


class Contact extends DatabaseV2Entity
{

    /** @var int $id */
    public $id;

    /** @var string $name */
    public $name;

    /** @var string $phone */
    public $phone;

    /** @var string $email */
    public $email;

    /** @var int $ord */
    public $ord;

    public function __construct() { }

    /**
     * @param string $name
     * @param bool $phone
     * @param string $email
     * @param int $ord
     * @return Contact
     */
    public static function constructWithParams($name, $phone, $email, $ord)
    {
        $instance = new Contact();

        $instance->name = $name;
        $instance->phone = $phone;
        $instance->email = $email;
        $instance->ord = $ord;

        return $instance;
    }

    /**
     * @param int $id
     * @param string $name
     * @param bool $phone
     * @param string $email
     * @param int $ord
     * @return Contact
     */
    public static function constructWithAllParams($id, $name, $phone, $email, $ord)
    {
        $instance = new Contact();

        $instance->id = $id;
        $instance->name = $name;
        $instance->phone = $phone;
        $instance->email = $email;
        $instance->ord = $ord;

        return $instance;
    }

    public function __toString()
    {
        return $this->name.", ".$this->phone.", ".$this->email;
    }


    public function getShortName()
    {
        return $this->name;
    }
}