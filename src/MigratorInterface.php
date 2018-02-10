<?php

namespace SerbanBlebea\Organize;

interface MigratorInterface
{
    public function migrate();

    public function drop();
}
