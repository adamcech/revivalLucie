<?php


class DatabaseV2MapperCol {

    /** @var string $col Column name in DB */
    public $col;

    /** @var string $property Name of property in corresponding entity */
    public $property;

    /** @var string $type Type of col, i = integer, d = double, s = string, b = blob (sent in packets) */
    public $type;

    /** @var bool $readOnly Marking col to be read only */
    public $readOnly;

    /** @var bool $pk Marking primary key */
    public $pk;

    /** @var int $orderPriority Marking primary key */
    public $orderPriority;

    /**
     * DatabaseV2MapperCol constructor.
     * @param string $col Column name in DB
     * @param string $property Name of property in corresponding entity
     * @param string $type Type of col, i = integer, d = double, s = string, b = blob (sent in packets)
     * @param bool $readOnly Marking read only status
     * @param bool $pk Marking primary key
     * @param int $orderPriority Order priority, lower number => bigger priority
     */
    public function __construct($col, $property, $type, $readOnly = false, $pk = false, $orderPriority = -1) {
        $this->col = $col;
        $this->property = $property;
        $this->type = $type;
        $this->readOnly = $readOnly;
        $this->pk = $pk;
        $this->orderPriority = $orderPriority;
    }

}