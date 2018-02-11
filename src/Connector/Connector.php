<?php

namespace SerbanBlebea\Organize\Connector;

class Connector
{
    private $host;
    private $dbName;
    private $user;
    private $password;

    private $connector;

    public function __construct($host, $dbName, $user, $password)
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->user = $user;
        $this->password = $password;

        $this->connector = $this->connect();
        $this->setUp();
    }

    public function setUp()
    {
        // Activate error print
        // TODO Should be turned on / off bt config environment - development / production
        $this->connector->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function connect()
    {
        $connector = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName . ";charset=utf8", $this->user, $this->password);
        return $connector;
    }

    public function getConnector()
    {
        return $this->connector;
    }
}
