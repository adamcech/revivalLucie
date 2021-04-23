<?php


class ConfigurationMapper extends DatabaseV2 {

    public function __construct() {
        $mapper = new DatabaseV2Mapper("settings",
            new DatabaseV2MapperCol("id", "id", "s"),
            new DatabaseV2MapperCol("int_val", "intVal", "i"),
            new DatabaseV2MapperCol("string_val", "stringVal", "s"));

        parent::__construct($mapper);
    }

    /**
     * @param ConfigurationProperties | string $property
     */
    public function decreaseProperty($property) {
        $this->query("UPDATE ".$this->mapper->tableName." SET int_val = int_val - 1 WHERE id = ?", "s", $property);
    }

    /**
     * @param ConfigurationProperties | string $property
     */
    public function increaseProperty($property) {
        $this->query("UPDATE ".$this->mapper->tableName." SET int_val = int_val + 1 WHERE id = ?", "s", $property);
    }

    /**
     * @param ConfigurationProperties | string $property
     * @param int $int_val
     * @param string $string_val
     */
    public function update($property, $int_val, $string_val) {
        $sql = "UPDATE ".$this->mapper->tableName." SET int_val = ?, string_val = ? WHERE id = ?";
        $this->query($sql, "iss", $int_val, $string_val, $property);
    }

    public function getIntProperty($property) {
        $sql = "SELECT int_val FROM ".$this->mapper->tableName." WHERE id = ?";
        return $this->queryAssoc($sql, "s", $property)[0]["int_val"];
    }

    public function getFileContainer() {
        return $this->getIntProperty("fileContainer");
    }

    public function getUploadCounter() {
        return $this->getIntProperty("uploadCounter");
    }

    /**
     * @return Files
     */
    public function getStageplan() {
        return (new FilesMapper())->selectByPk(intval($this->getIntProperty(ConfigurationProperties::FILES_ID_STAGEPLAN)));
    }

    /**
     * @return Files
     */
    public function getPlaylist() {
        return (new FilesMapper())->selectByPk(intval($this->getIntProperty(ConfigurationProperties::FILES_ID_PLAYLIST)));
    }

    /**
     * @return Configuration
     */
    protected function getEntityInstance() {
        return new Configuration();
    }

    public function insert($entity) { }

    public function selectAll($orderAsc = true) { }

    public function selectByPk($primaryKeyValue) { }

    public function delete($entity) { }

    public function updateByPk($entity) { }

}

