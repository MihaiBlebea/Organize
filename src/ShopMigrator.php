<?php

namespace SerbanBlebea\Organize;

use SerbanBlebea\Organize\Migrator;
use SerbanBlebea\Organize\MigratorInterface;
use SerbanBlebea\Organize\Column;

class ShopMigrator extends Migrator implements MigratorInterface
{
    public $tableName = "shops";

    public function migrate()
    {
        $id = Column::with()->name("id")
                            ->integer(11)
                            ->default("NULL")
                            ->isKey(true, "PRIMARY")
                            ->autoIncrement(true);

        $shop_name = Column::with()->name("shop_name")
                                   ->string(255)
                                   ->default("NULL");

        $shop_token = Column::with()->name("shop_token")
                                    ->string(255)
                                    ->default("NOT NULL");

        $is_installed = Column::with()->name("is_installed")
                                      ->integer(10)
                                      ->default("NOT NULL");

        $this->addColumns([$id, $shop_name, $shop_token, $is_installed])
             ->createSchema()
             ->runMigration();
    }

    public function drop()
    {
        $this->dropTable();
    }
}
