<?php

namespace SerbanBlebea\Organize;

use SerbanBlebea\Organize\Connector\Connector;
use SerbanBlebea\Organize\Migrate\Migrator;
use SerbanBlebea\Organize\Factory\ConnectorFactory;

class Organize
{
    private $connector;

    public $setup = [];

    public $migrations = [];

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function setup(Array $setup)
    {
        $this->setup = $setup;
        $this->storeMigrations();
    }

    public function storeMigrations()
    {
        if(count($this->setup["migrations"]) > 0)
        {
            foreach($this->setup["migrations"] as $migration)
            {
                $class = new $migration($this->connector);
                array_push($this->migrations, $class);
            }
        }
    }

    public function getConnector()
    {
        return ($this->connector !== null) ? $this->connector : ConnectorFactory::build();
    }

    public function dispatchMigrations()
    {
        foreach($this->migrations as $migration)
        {
            $migration->migrate();
        }
    }

    public function dropMigrations()
    {
        foreach($this->migrations as $migration)
        {
            $migration->drop();
        }
    }
}
