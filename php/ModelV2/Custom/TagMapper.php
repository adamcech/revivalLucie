<?php


class TagMapper extends DatabaseV2 {

    public function __construct() {
        $mapper = new DatabaseV2Mapper("tags",
            new DatabaseV2MapperCol("id", "id", "i", true, true),
            new DatabaseV2MapperCol("name", "name", "s"),
            new DatabaseV2MapperCol("ord", "ord", "i", false, false, 0));

        parent::__construct($mapper);
    }

    /**
     * @param Tag $tag
     * @return DatabaseV2Result
     * @throws Exception
     */
    public function insert($tag)
    {
        $insert = parent::insert($tag);

        $tag->id = $insert->lastInsertId;
        $tag->ord = $insert->lastInsertId;
        $this->updateByPk($tag);

        return $insert;
    }

    /**
     * @return Tag
     */
    protected function getEntityInstance() {
        return new Tag();
    }

}

