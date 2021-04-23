<?php


class ConcertMapper extends DatabaseV2 {

    public function __construct() {
        $mapper = new DatabaseV2Mapper("concerts",
            new DatabaseV2MapperCol("id", "id", "i", true, true),
            new DatabaseV2MapperCol("date", "date", "s", false, false, 0),
            new DatabaseV2MapperCol("name", "name", "s"),
            new DatabaseV2MapperCol("place", "place", "s"));

        parent::__construct($mapper);
    }

    /**
     * @param bool $orderAsc Change sorting, default is false. Latest to Oldest.
     * @return DatabaseV2Result
     * @throws Exception
     */
    public function selectAll($orderAsc = false) {
        // Default value of $orderAsc is changed
        return parent::selectAll($orderAsc);
    }

    public function selectUpcoming() {
        $sql = $this->mapper->generateSqlSelectAll()." WHERE date >= NOW() or date = CURDATE() ORDER BY date ASC";
        return $this->query($sql);
    }

    public function selectPast() {
        $sql = $this->mapper->generateSqlSelectAll()." WHERE date < SUBDATE(NOW(), 1) ORDER BY date DESC";
        return $this->query($sql);
    }

    /**
     * @return Concert
     */
    protected function getEntityInstance() {
        return new Concert();
    }

}

