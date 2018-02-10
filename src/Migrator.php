<?php

namespace SerbanBlebea\Organize;

use Framework\Database\Connector;
use Framework\Injectables\Injector;
use SerbanBlebea\Organize\Column;

class Migrator
{
    private $connector = null;

    private $schema = null;

    private $column;

    private $columns = [];


    public function __construct()
    {
        $conn = Injector::resolve("Connector");
        $this->connector = $conn->getConnector();
    }

    public function addColumn(Column $column)
    {
        array_push($this->columns, $column);
        return $this;
    }

    public function addColumns(Array $columns)
    {
        $this->columns = $columns;
        return $this;
    }

    private function typeAndLength(Column $column)
    {
        if($column->getType() == "TIMESTAMP")
        {
            return " " . $column->getType();
        } else {
            return " " . $column->getType() . "(" . $column->getLength() . ")";
        }
    }

    // Check if the prop is null or not before nserting it into the schema
    private function notNull($prop)
    {
        if($prop !== null)
        {
            return " " . $prop;
        } else {
            return "";
        }
    }

    // Add default timestamp columns in database
    public function addDefaultColumns()
    {
        $updated_time = Column::with()->name("updated_date")
                                      ->timestamp();

        $created_date = Column::with()->name("created_date")
                                      ->timestamp()
                                      ->default("DEFAULT CURRENT_TIMESTAMP");

        $this->addColumn($updated_time)
             ->addColumn($created_date);
    }

    public function createSchema()
    {
        // Add default columns to the table
        $this->addDefaultColumns();

        // Add header to schema
        $this->schema = null;
        $this->schema .= "CREATE TABLE " . $this->getTableName() . " (";

        // Add columns to schema
        foreach($this->columns as $index => $column)
        {
            // dd($column->check());
            $this->schema .= $column->getName() .
                             $this->typeAndLength($column) .
                             $this->notNull($column->getDefault()) .
                             $this->notNull($column->getKey()) .
                             $this->notNull($column->getUnique()) .
                             $this->notNull($column->getAutoIncrement()) .
                             $this->notNull($column->getOnUpdate()) .
                             (($index < count($this->columns) - 1) ? ", " : "");
        }
        $this->schema .= ")";

        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    function runMigration()
    {
        try {
            $this->connector->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $result = $this->connector->exec($this->schema);
        } catch(PDOException $e) {
            dd($e);
        }
        dd($result);
    }

    function dropTable()
    {
        $this->schema = "DROP TABLE " . $this->tableName;
        $this->runMigration();
    }
}
