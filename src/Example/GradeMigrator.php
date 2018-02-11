<?php

namespace SerbanBlebea\Organize\Example;

use SerbanBlebea\Organize\Migrate\Migrator;
use SerbanBlebea\Organize\Interfaces\MigratorInterface;
use SerbanBlebea\Organize\Migrate\Column;

class GradeMigrator extends Migrator implements MigratorInterface
{
    public function getTableName()
    {
        return "grades";
    }

    public function migrate()
    {
        $id = Column::with()->name("id")
                            ->integer(11)
                            ->default("NULL")
                            ->isKey(true, "PRIMARY")
                            ->autoIncrement(true);

        $grade = Column::with()->name("grade")
                               ->integer(10)
                               ->default("NULL");

        $subject = Column::with()->name("subject")
                                 ->string(255)
                                 ->default("NULL");

        $this->addColumns([$id, $grade, $subject])
             ->createSchema()
             ->runMigration();
    }

    public function drop()
    {
        $this->dropTable();
    }
}
