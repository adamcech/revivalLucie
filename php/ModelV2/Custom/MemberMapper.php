<?php


class MemberMapper extends DatabaseV2 {

    public function __construct() {
        $mapper = new DatabaseV2Mapper("members",
            new DatabaseV2MapperCol("id", "id", "i", true, true),
            new DatabaseV2MapperCol("name", "name", "s"),
            new DatabaseV2MapperCol("role", "role", "s"),
            new DatabaseV2MapperColLeftJoin("files_id", "file", "files", "id", "id"),
            new DatabaseV2MapperCol("ord", "ord", "i", false, false, 0));

        parent::__construct($mapper);
    }

    /**
     * @param Member $member
     * @return DatabaseV2Result
     * @throws Exception
     */
    public function insert($member)
    {
        $insert = parent::insert($member);

        $member->id = $insert->lastInsertId;
        $member->ord = $insert->lastInsertId;
        $this->updateByPk($member);

        return $insert;
    }

    /**
     * @return Member
     */
    protected function getEntityInstance() {
        return new Member();
    }

}

