<?php


class Configuration extends DatabaseV2Entity
{
    /** @var int $id Contains key of configuration property */
    public $id;

    /** @var int $intVal Int value of property */
    public $intVal;

    /** @var string $stringVal String value of property */
    public $stringVal;

    public function __construct() { }

    /**
     * Configuration constructor.
     * @param string $id Contains key of configuration property
     * @param int $intVal Int value of property
     * @param string $stringVal String value of property
     * @return Configuration
     */
    public static function constructWithParams($id, $intVal, $stringVal)
    {
        $instance = new Configuration();

        $instance->id = $id;
        $instance->intVal = $intVal;
        $instance->stringVal = $stringVal;

        return $instance;
    }

    public function getShortName()
    {
        return $this->id;
    }
}