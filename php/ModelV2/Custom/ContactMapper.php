<?php


class ContactMapper extends DatabaseV2 {

    public function __construct() {
        $mapper = new DatabaseV2Mapper("contact",
            new DatabaseV2MapperCol("id", "id", "i", true, true),
            new DatabaseV2MapperCol("name", "name", "s"),
            new DatabaseV2MapperCol("phone", "phone", "s"),
            new DatabaseV2MapperCol("email", "email", "s"),
            new DatabaseV2MapperCol("ord", "ord", "i", false, false, 0));

        parent::__construct($mapper);
    }

    /**
     * @param Contact $contact
     * @return DatabaseV2Result
     */
    public function insert($contact)
    {
        $insert = parent::insert($contact);

        $contact->id = $insert->lastInsertId;
        $contact->ord = $insert->lastInsertId;
        $this->updateByPk($contact);

        return $insert;
    }

    /**
     * @return Contact
     */
    protected function getEntityInstance() {
        return new Contact();
    }

}

