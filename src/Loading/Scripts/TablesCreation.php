<?php

namespace Src\Loading\Scripts;

use Src\Loading\SchemaBuilder\Builder;
use Src\Loading\SchemaBuilder\Schemas\PosGradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosDocSchemas;

class TablesCreation
{
    public function __construct()
    {
        $this->builder = new Builder();
    }

    public function getTablesNames($class)
    {
        $refl = new \ReflectionClass($class);
        $tables = $refl->getConstants();

        return $tables;
    }

    public function createTables($class)
    {
        $tables = $this->getTablesNames($class);

        foreach($tables as $table)
        {
            $this->builder->createTable($table);
        }
    }

    public function dropTables($class)
    {
        $tables = $this->getTablesNames($class);

        foreach($tables as $table)
        {
            $this->builder->dropTable($table);
        }
    }

    public function recreateTables($class)
    {
       $this->dropTables($class);
       $this->createTables($class);
    }
}