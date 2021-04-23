<?php


class FilesMapper extends DatabaseV2 {

    public function __construct() {
        $mapper = new DatabaseV2Mapper("files",
            new DatabaseV2MapperCol("id", "id", "i", true, true),
            new DatabaseV2MapperCol("name", "name", "s", false, false, 0),
            new DatabaseV2MapperCol("id_name", "idName", "s"),
            new DatabaseV2MapperCol("type", "type", "s"),
            new DatabaseV2MapperCol("shortcut", "shortcut", "s")
        );

        parent::__construct($mapper);
    }

    /**
     * @param $query
     * @param null $limit
     * @param bool $imageOnly
     * @return DatabaseV2Result
     */
    public function search($query, $limit = null, $imageOnly = false) {
        $query = "%".$query."%";

        $sql = "SELECT ".$this->mapper->generateSqlColsAll()." FROM ".$this->mapper->tableName." WHERE name LIKE ?";

        if ($imageOnly) {
            $sql .= " AND (shortcut = 'jpg' OR shortcut = 'jpeg' OR shortcut = 'png' OR shortcut = 'gif')";
        }

        $sql .= " ORDER BY id DESC";

        if ($limit !== null) {
            $sql .= " LIMIT ?";
        }

        if ($limit === null) {
            return $this->query($sql, "s", $query);
        } else {
            return $this->query($sql, "si", $query, $limit);
        }
    }

    /**
     * @param $from
     * @param $limit
     * @return DatabaseV2Result
     */
    public function selectLimit($from, $limit) {
        $sql = "SELECT ".$this->mapper->generateSqlColsAll()." FROM ".$this->mapper->tableName." ORDER BY id DESC LIMIT ?, ?";
        return $this->query($sql, "ii", $from, $limit);
    }

    /**
     * @param Files $file
     * @return DatabaseV2Result
     */
    public function delete($file) {
        return $this->deleteByPk($file->id);
    }

    /**
     * @param mixed $primaryKeyValue
     * @return DatabaseV2Result
     */
    public function deleteByPk($primaryKeyValue) {
        /** @var Files $file */
        $file = $this->selectByPk($primaryKeyValue);

        if ($file === null) {
            return new DatabaseV2Result(1, 1, -1, []);
        }

        $deleteQuery = parent::deleteByPk($primaryKeyValue);

        if ($file->idName !== null) {
            try {
                unlink($_SERVER['DOCUMENT_ROOT']."/files/".$file->idName);
                if ($file->isImage()) {
                    unlink($_SERVER['DOCUMENT_ROOT']."/files/mini/".$file->idName);
                }
            } catch (Exception $exception) { }
        }


        $galleryMapper = new GalleryMapper();
        $galleryMapper->deleteByFilesId($primaryKeyValue);

        return $deleteQuery;
    }

    /**
     * @return Files
     */
    protected function getEntityInstance() {
        return new Files();
    }


    /**
     * @param mixed $primaryKeyValue
     * @return Files
     */
    public function selectByPk($primaryKeyValue)
    {
        return parent::selectByPk($primaryKeyValue);
    }

}

