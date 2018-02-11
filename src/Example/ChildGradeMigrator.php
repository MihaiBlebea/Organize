<?php

namespace SerbanBlebea\Organize\Example;

use SerbanBlebea\Organize\Migrate\Migrator;
use SerbanBlebea\Organize\Interfaces\MigratorInterface;
use SerbanBlebea\Organize\Migrate\Column;

class ChildGradeMigrator extends Migrator implements MigratorInterface
{
    public function getTableName()
    {
        return "child_grade";
    }

    public function migrate()
    {
        $id = Column::with()->name("id")
                            ->integer(11)
                            ->default("NULL")
                            ->isKey(true, "PRIMARY")
                            ->autoIncrement(true);

        $child_id = Column::with()->name("child_id")
                                 ->integer(11)
                                 ->default("NULL");

        $grade_id = Column::with()->name("grade_id")
                                  ->integer(11)
                                  ->default("NULL");

        $this->addColumns([$id, $child_id, $grade_id])
             ->createSchema()
             ->runMigration();
    }

    public function drop()
    {
        $this->dropTable();
    }
}
