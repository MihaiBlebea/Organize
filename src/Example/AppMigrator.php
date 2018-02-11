<?php

namespace SerbanBlebea\Organize\Example;

use SerbanBlebea\Organize\Migrate\Migrator;
use SerbanBlebea\Organize\Interfaces\MigratorInterface;
use SerbanBlebea\Organize\Migrate\Column;

class AppMigrator extends Migrator implements MigratorInterface
{
    public function getTableName()
    {
        return "apps";
    }

    public function migrate()
    {
        $id = Column::with()->name("id")
                            ->integer(11)
                            ->default("NULL")
                            ->isKey(true, "PRIMARY")
                            ->autoIncrement(true);

        $shop_id = Column::with()->name("shop_id")
                                 ->integer(11)
                                 ->default("NULL");

        $app_name = Column::with()->name("app_name")
                                  ->string(255)
                                  ->default("NULL");

        $app_price = Column::with()->name("app_price")
                                   ->integer(15)
                                   ->default("NOT NULL");

        $is_active = Column::with()->name("is_active")
                                   ->integer(10)
                                   ->default("NULL");

        $this->addColumns([$id, $shop_id, $app_name, $app_price, $is_active])
             ->createSchema()
             ->runMigration();
    }

    public function drop()
    {
        $this->dropTable();
    }
}
