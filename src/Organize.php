<?php

namespace App\Database;

use App\Database\Connector\Connector;
use App\Database\Migrate\Migrator;

class Organize
{
    private $connector = null;

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
