<?php


class Concert extends DatabaseV2Entity
{

    /** @var int $id */
    public $id;

    /** @var string $date YYYY-MM-DD */
    public $date;

    /** @var string $name */
    public $name;

    /** @var string $place */
    public $place;

    public function __construct() { }

    /**
     * @param string $date YYYY-MM-DD
     * @param string $name
     * @param string $place
     * @return Concert
     */
    public static function constructWithParams($date, $name, $place)
    {
        $instance = new Concert();

        $instance->date = $date;
        $instance->name = $name;
        $instance->place = $place;

        return $instance;
    }

    /**
     * @param int $id
     * @param DateTime $date
     * @param string $name
     * @param string $place
     * @return Concert
     */
    public static function constructWithAllParams($id, $date, $name, $place)
    {
        $instance = new Concert();

        $instance->id = $id;
        $instance->date = $date;
        $instance->name = $name;
        $instance->place = $place;

        return $instance;
    }

    public function __toString()
    {
        $date = strtotime($this->date);
        $formatted = date( 'd. m. Y', $date);

        return $formatted." ----- ".$this->name;
    }

    public function getShortName()
    {
        return $this->name;
    }
}