<?php

namespace SerbanBlebea\Organize\Example;

use SerbanBlebea\Organize\Migrate\Migrator;
use SerbanBlebea\Organize\Interfaces\MigratorInterface;
use SerbanBlebea\Organize\Migrate\Column;

class ChildMigrator extends Migrator implements MigratorInterface
{
    public function getTableName()
    {
        return "children";
    }

    public function migrate()
    {
        $id = Column::with()->name("id")
                            ->integer(11)
                            ->default("NULL")
                            ->isKey(true, "PRIMARY")
                            ->autoIncrement(true);

        $first_name = Column::with()->name("first_name")
                                   ->string(255)
                                   ->default("NULL");

        $last_name = Column::with()->name("last_name")
                                    ->string(255)
                                    ->default("NULL");

        $this->addColumns([$id, $first_name, $last_name])
             ->createSchema()
             ->runMigration();
    }

    public function drop()
    {
        $this->dropTable();
    }
}
