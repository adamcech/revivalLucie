<?php

class DatabaseV2Result {

    /** @var int $numRows Number of rows */
    public $numRows;

    /** @var int $affectedRows Number of affected rows */
    public $affected_rows;

    /** @var int $lastInsertId Id of last inserted item */
    public $lastInsertId;

    /** @var DatabaseV2Entity[] $results Stored results */
    public $results;

    /**
     * DatabaseV2Result constructor.
     * @param int $numRows Number of rows
     * @param int $affectedRows Number of affected rows
     * @param int $lastInsertId Id of last inserted item
     * @param DatabaseV2Entity[] $results Stored results
     */
    public function __construct($numRows, $affectedRows, $lastInsertId, array $results) {
        $this->numRows = $numRows;
        $this->affected_rows = $affectedRows;
        $this->lastInsertId = $lastInsertId;
        $this->results = $results;
    }

    public function printResults() {
        echo "num_rows: $this->numRows<br/>";
        echo "affected_rows: $this->affected_rows<br/>";
        echo "last_insert_id: $this->lastInsertId<br/>";
        echo "results:<br/>";
        foreach ($this->results as $result) {
            echo $result."<br/>";
        }
        echo "<br/><br/>";
    }
}