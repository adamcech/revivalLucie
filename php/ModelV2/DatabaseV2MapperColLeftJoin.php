<?php


class DatabaseV2MapperColLeftJoin {

    public $col;
    public $property;
    public $foreignTable;
    public $foreignCol;
    public $foreignProperty;

    /**
     * DatabaseV2MapperColLeftJoin constructor.
     * @param $col
     * @param $property
     * @param $foreignTable
     * @param $foreignCol
     * @param $foreignProperty
     */
    public function __construct($col, $property, $foreignTable, $foreignCol, $foreignProperty)
    {
        $this->col = $col;
        $this->property = $property;
        $this->foreignTable = $foreignTable;
        $this->foreignCol = $foreignCol;
        $this->foreignProperty = $foreignProperty;
    }
}