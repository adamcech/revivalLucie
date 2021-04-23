<?php


class DatabaseV2Mapper {

    /** @var string $tableName Name of table in DB */
    public $tableName;

    /** @var DatabaseV2MapperCol | null $pk Primary key if any, otherwise null */
    public $pk;

    /** @var DatabaseV2MapperCol[] $cols Info for mapping col to entity */
    public $cols;

    /** @var string[] $propertiesTables Dict from db table name to property */
    public $propertiesTables;

    /** @var array[] $orderCols Order of cols to be used for sorting */
    private $orderCols;

    /** @var bool $hasForeignKeyProp Flag if any of properties is foreign key */
    private $hasForeignKeyProp;

    /** @var string[] $propsDict Dict with name of db cols to properties names */
    public $propsDict;

    /**
     * DatabaseV2Mapper constructor.
     * @param string $tableName of table in DB
     * @param DatabaseV2MapperCol[]|DatabaseV2MapperColLeftJoin[] ...$cols Info for mapping col to entity
     */
    public function __construct($tableName, ...$cols) {
        $this->hasForeignKeyProp = false;

        $this->tableName = $tableName;
        $this->cols = $cols;

        $this->orderCols = [];
        $this->propsDict = [];

        foreach ($this->cols as $col) {
            if ($col instanceof DatabaseV2MapperCol) {
                /** @var DatabaseV2MapperCol $col */

                if ($col->pk) {
                    if ($this->hasPrimaryKey()) {
                        try {
                            throw new Exception("Warning: Multiple Primary Keys");
                        } catch (Exception $e) {
                            echo $e;
                        }
                    } else {
                        $this->pk = $col;
                    }
                }

                if ($col->orderPriority >= 0) {
                    $this->orderCols[intval($col->orderPriority)] = $col->col;
                }

                $this->propsDict[$this->tableName."_".$col->col] = $col->property;
            } else if ($col instanceof DatabaseV2MapperColLeftJoin) {
                /** @var DatabaseV2MapperColLeftJoin $col */

                $this->propertiesTables[$col->foreignTable] = $col->property;
                $this->hasForeignKeyProp = true;

                $otherMapper = DatabaseV2::getMapperByTableName($col->foreignTable);
                foreach ($otherMapper->mapper->cols as $foreignCol) {
                    $this->propsDict[$col->foreignTable."_".$foreignCol->col] = $foreignCol->property;
                }
            }
        }

        ksort($this->orderCols);
    }

    public function hasPrimaryKey() {
        return $this->pk !== null;
    }

    private function hasForeignKey() {
        return $this->hasForeignKeyProp;
    }

    /**
     * @param bool $skipReadOnly Skip read only columns
     * @return string Cols names separated by comma, usable for SELECT of all columns e.g.: "id, origin_date, mark"
     */
    public function generateSqlColsAll($skipReadOnly = false) {
        $str = "";
        foreach ($this->cols as $col) {
            if ($col instanceof DatabaseV2MapperCol) {
                /** @var DatabaseV2MapperCol $col */

                if ($skipReadOnly && $col->readOnly) {
                    continue;
                }

                if (strlen($str) > 0) {
                    $str .= ", ";
                }

                $str .= $this->tableName.".".$col->col." ".$this->tableName."_".$col->col;
            } else if ($col instanceof DatabaseV2MapperColLeftJoin) {
                /** @var DatabaseV2MapperColLeftJoin $col */

                $foreignMapper = DatabaseV2::getMapperByTableName($col->foreignTable);

                $foreignStr = $foreignMapper->mapper->generateSqlColsAll();
                $str .= strlen($str) == 0 ? $foreignStr : ", ".$foreignStr;
            }
        }
        return $str;
    }

    public function generateSqlSelectAll()
    {
        if ($this->hasForeignKey()) {
            $str = "SELECT ".$this->generateSqlColsAll()." FROM ".$this->tableName;

            foreach ($this->cols as $col) {
                if ($col instanceof DatabaseV2MapperColLeftJoin) {
                    /** @var DatabaseV2MapperColLeftJoin $col */
                    $str .= " LEFT JOIN ".$col->foreignTable." ON ".$this->tableName.".".$col->col." = ".$col->foreignTable.".".$col->foreignCol;
                }
            }
            return $str;
        } else {
            return "SELECT ".$this->generateSqlColsAll()." FROM ".$this->tableName;
        }
    }

    /**
     * @param bool $orderAsc
     * @return string
     */
    public function generateSqlOrderBy($orderAsc)
    {
        // Use order cols, set by mapper
        $str = "";
        foreach ($this->orderCols as $col) {
            $col = $this->tableName.".".$col;
            $str .= strlen($str) == 0 ? $col : ", ".$col;
        }

        // Use PK if not any order col is set, also if no PK is existing use 1st col.
        if ($str == ""){
            $str .= $this->hasPrimaryKey() ? $this->tableName.".".$this->pk->col : $this->tableName.".".$this->cols[0]->col;
        }

        return " ORDER BY ".$str." ".($orderAsc ? "ASC" : "DESC");
    }

}