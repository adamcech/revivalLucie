<?php

class DatabaseV2Connector {

    /** @var mysqli $conn DB connector */
    public $conn;

    public function __construct()
    {
        $config = Config::getConfig();

        $this->conn = new mysqli($config->dbServername, $config->dbUsername, $config->dbPassword, $config->dbName);
        $this->conn->set_charset("windows-1250");
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
