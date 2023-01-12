<?php

namespace Src\Loading\Scripts;

use Src\Loading\SchemaBuilder\Builder;
use Src\Loading\SchemaBuilder\Schemas\GradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosDocSchemas;

class TablesCreation
{
    public function __construct()
    {
        $this->builder = new Builder();
    }

    public function recreateTables(array $tables)
    {
        foreach($tables as $table)
        {
            $this->builder->dropTable($table);
        }

        foreach($tables as $table)
        {
            $this->builder->createTable($table);
        }
    }

    public function newGradTables()
    {
        $refl = new \ReflectionClass(GradSchemas::class);
        $gradTables = $refl->getConstants();
        $this->recreateTables($gradTables);
    }

    public function newPosGradTables()
    {
        $refl = new \ReflectionClass(PosGradSchemas::class);
        $posGradTables = $refl->getConstants();
        $this->recreateTables($posGradTables);
    }

    public function newPosDocTables()
    {
        $refl = new \ReflectionClass(PosDocSchemas::class);
        $posDocTables = $refl->getConstants();
        $this->recreateTables($posDocTables);
    }
}