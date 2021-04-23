<?php


class PlaylistMapper extends DatabaseV2 {

    public function __construct() {
        $mapper = new DatabaseV2Mapper("playlist",
            new DatabaseV2MapperCol("id", "id", "i", true, true),
            new DatabaseV2MapperCol("name", "name", "s"),
            new DatabaseV2MapperCol("comment", "comment", "s"),
            new DatabaseV2MapperCol("ord", "ord", "i",false, false, 0));

        parent::__construct($mapper);
    }

    /**
     * @param Playlist $playlist
     * @return DatabaseV2Result
     */
    public function insert($playlist)
    {
        $insert = parent::insert($playlist);

        $playlist->id = $insert->lastInsertId;
        $playlist->ord = $insert->lastInsertId;
        $this->updateByPk($playlist);

        return $insert;
    }


    /**
     * @return Playlist
     */
    protected function getEntityInstance() {
        return new Playlist();
    }

}

