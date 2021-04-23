<?php

abstract class DatabaseV2 {

    /** @return DatabaseV2Entity */
    abstract protected function getEntityInstance();



    /** @var DatabaseV2Mapper $mapper Contains table mapping info */
    public $mapper;

    /**
     * DatabaseV2 constructor.
     * @param DatabaseV2Mapper $mapper Containing info for table mapping
     */
    protected function __construct($mapper) {
        $this->mapper = $mapper;
    }

    private function validatePrimaryKey() {
        if (!$this->mapper->hasPrimaryKey()) {
            throw new Exception("Warning: Table doesn't have primary key, cannot select by primary key...");
        }
    }

    private function getArrayRefs($arr) {
        $refs = array();

        foreach ($arr as $key => $value)
        {
            $refs[$key] = &$arr[$key];
        }
        return $refs;
    }

    /**
     * @param DatabaseV2Connector $db Connector to DB
     * @param string $sql SQL statement
     * @param array $bindParams Array of params to bind
     * @param string $bindParamsType String with types of bind params (isdb)
     * @return mysqli_stmt Created stmt
     *@throws Exception Incorrect SQL
     */
    private function prepare($db, $sql, $bindParams, $bindParamsType) {
        $stmt = $db->conn->prepare($sql);

        if ($bindParamsType !== null && is_array($bindParams)) {
            if (count($bindParams) == 1 && is_array($bindParams[0])) {
                $bindParams = $bindParams[0];
            }

            array_unshift($bindParams, $bindParamsType);
            call_user_func_array(array($stmt, 'bind_param'), $this->getArrayRefs($bindParams));
        }

        if (!$stmt) {
            throw new Exception("Incorrect SQL: ".$sql."; Connector Err: ".$db->conn->error.";");
        }

        return $stmt;
    }

    /**
     * @param string $sql
     * @param null | string $bindParamsType
     * @param array ...$bindParams
     * @return array
     *@throws Exception Incorrect SQL
     */
    protected function queryAssoc($sql, $bindParamsType = null, ...$bindParams) {
        $db = new DatabaseV2Connector();

        $stmt = $this->prepare($db, $sql, $bindParams, $bindParamsType);

        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $stmt->free_result();
        $stmt->close();

        return $results;
    }

    /**
     * @param string $sql
     * @param null | string $bindParamsType
     * @param array ...$bindParams
     * @return DatabaseV2Result
     *@throws Exception Incorrect SQL
     */
    protected function query($sql, $bindParamsType = null, ...$bindParams) {
        $db = new DatabaseV2Connector();
        $results = [];

        $stmt = $this->prepare($db, $sql, $bindParams, $bindParamsType);
        $stmt->execute();

        $affectedRows = $stmt->affected_rows;
        $lastInsertId = $stmt->insert_id;
        $numRows = $stmt->num_rows;

        if ($affectedRows === - 1) {
            $fetchedResults = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            foreach ($fetchedResults as $result) {
                $instance = $this->getEntityInstance();

                foreach (array_keys($result) as $resultKey) {
                    $parts = explode("_", $resultKey);
                    $table = $parts[0];
                    $col = $parts[1];

                    if ($this->mapper->tableName === $table) {
                        $instance->{$this->mapper->propsDict[$resultKey]} = $result[$resultKey];
                    } else {
                        $instance->{$this->mapper->propertiesTables[$table]}->{$this->mapper->propsDict[$resultKey]} = $result[$resultKey];
                    }
                }
                $results[] = $instance;
            }
        }

        $stmt->free_result();
        $stmt->close();

        if (strtoupper(substr(ltrim($sql), 0, 6)) === "SELECT") {
            $numRows = sizeof($results);
        }

        return new DatabaseV2Result($numRows, $affectedRows, $lastInsertId, $results);
    }

    /**
     * @param bool $orderAsc Sort ASC by default, false for DESC.
     * @return DatabaseV2Result
     * @throws Exception
     */
    public function selectAll($orderAsc = true)
    {
        $sql = $this->mapper->generateSqlSelectAll().$this->mapper->generateSqlOrderBy($orderAsc);
        return $this->query($sql);
    }

    /**
     * @param mixed $primaryKeyValue Row to select by using primary key
     * @return DatabaseV2Entity
     * @throws Exception
     */
    public function selectByPk($primaryKeyValue) {
        $this->validatePrimaryKey();

        $sql = $this->mapper->generateSqlSelectAll()." WHERE ".$this->mapper->tableName.".".$this->mapper->pk->col." = ?";
        return $this->query($sql, $this->mapper->pk->type, $primaryKeyValue)->results[0];
    }

    /**
     * @param DatabaseV2Entity $entity Row to delete by entity values
     * @return DatabaseV2Result
     * @throws Exception
     */
    public function delete($entity) {
        $sql = "DELETE FROM ".$this->mapper->tableName." WHERE ";

        // Use all values of entity in WHERE clause
        $types = "";
        $values = [];
        $where = "";

        foreach ($this->mapper->cols as $col) {
            $types .= $col->type;
            $values[] = $entity->{$col->property};

            if (strlen($where) !== 0) {
                $where .= " AND ";
            }

            $where .= $col->col." = ?";
        }

        $sql .= $where;
        return $this->query($sql, $types, $values);
    }

    /**
     * @param mixed $primaryKeyValue Row to delete by using primary key
     * @return DatabaseV2Result
     * @throws Exception
     */
    public function deleteByPk($primaryKeyValue) {
        $this->validatePrimaryKey();

        $sql = "DELETE FROM ".$this->mapper->tableName." WHERE ".$this->mapper->pk->col." = ?";
        return $this->query($sql, $this->mapper->pk->type, $primaryKeyValue);
    }

    /**
     * @param DatabaseV2Entity $entity Row to delete by entity values
     * @return DatabaseV2Result
     * @throws Exception
     */
    public function insert($entity) {
        $types = "";
        $values = [];
        $marks = "";
        $cols = "";

        foreach ($this->mapper->cols as $col) {
            if ($col instanceof DatabaseV2MapperCol) {
                if ($col->readOnly) {
                    continue;
                }

                $types .= $col->type;
                $values[] = $entity->{$col->property};
            } else if ($col instanceof DatabaseV2MapperColLeftJoin) {
                $types .= "i";
                $values[] = $entity->{$col->property}->{$col->foreignProperty};
            }

            if (strlen($marks) !== 0) {
                $marks .= ", ";
                $cols .= ", ";
            }

            $marks .= "?";
            $cols .= $col->col;
        }

        $sql = "INSERT INTO ".$this->mapper->tableName." ($cols) VALUES ($marks)";
        return $this->query($sql, $types, $values);
    }

    /**
     * @param DatabaseV2Entity $entity Row to update by entity values
     * @return DatabaseV2Result
     * @throws Exception
     */
    public function updateByPk($entity) {
        $this->validatePrimaryKey();

        $types = "";
        $values = [];
        $set = "";

        foreach ($this->mapper->cols as $col) {
            if ($col instanceof DatabaseV2MapperCol) {
                if ($col->readOnly) {
                    continue;
                }

                $types .= $col->type;
                $values[] = $entity->{$col->property};
            } else if ($col instanceof DatabaseV2MapperColLeftJoin) {
                $types .= "i";
                $values[] = $entity->{$col->property}->{$col->foreignProperty};
            }

            if (strlen($set) !== 0) {
                $set .= ", ";
            }

            $set .= $col->col." = ?";
        }

        $sql = "UPDATE ".$this->mapper->tableName." SET $set WHERE ".$this->mapper->pk->col." = ?";

        $types .= $this->mapper->pk->type;
        $values[] = $entity->{$this->mapper->pk->property};

        return $this->query($sql, $types, $values);
    }

    /**
     * @return int
     * @throws Exception
     */
    public function countAllRows() {
        $sql = "SELECT COUNT(".$this->mapper->cols[0]->col.") AS c FROM ".$this->mapper->tableName;
        return intval($this->queryAssoc($sql)[0]["c"]);
    }

    /**
     * @param int $id_0 First row id
     * @param int $id_1 Second row id
     * @param string $propertyName Param to switch
     * @throws Exception
     */
    public function swapPropertyByPk($id_0, $id_1, $propertyName)
    {
        /** @var DatabaseV2Entity $first */
        $first = $this->selectByPk($id_0);

        /** @var DatabaseV2Entity $second */
        $second = $this->selectByPk($id_1);

        $backup = $first->{$propertyName};
        $first->{$propertyName} = $second->{$propertyName};
        $second->{$propertyName} = $backup;

        $this->updateByPk($first);
        $this->updateByPk($second);
    }



    /**
     * @param $tableName
     * @return DatabaseV2|null
     */
    public static function getMapperByTableName($tableName) {
        switch ($tableName) {
            case "contact": return new ContactMapper(); break;
            case "concerts": return new ConcertMapper(); break;
            case "gallery": return new GalleryMapper(); break;
            case "playlist": return new PlaylistMapper(); break;
            case "files": return new FilesMapper(); break;
            case "members": return new MemberMapper(); break;
            case "tags": return new TagMapper(); break;
            default: return null; break;
        }
    }
}
