<?php

namespace SerbanBlebea\Organize\Interfaces;

interface MigratorInterface
{
    public function getTableName();

    public function migrate();

    public function drop();
}
