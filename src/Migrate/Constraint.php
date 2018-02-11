<?php

namespace SerbanBlebea\Organize\Migrate;

class Constraint
{
    private $table_name = null;

    private $constraint_name;

    private $column_name;

    private $condition;

    private $schema = null;


    public function __construct(String $column_name, String $condition, String $table_name = null)
    {
        $this->table_name = $table_name;
        $this->constraint_name = $column_name . "_constraint";
        $this->column_name = $column_name;
        $this->condition = $condition;

        $this->createSchema();
    }

    private function createSchema()
    {
        $this->schema = "CHECK (" . $this->column_name . " " . $this->condition . ")";
        // dd($this->schema);
    }

    public function get()
    {
        return $this->schema;
    }
}
