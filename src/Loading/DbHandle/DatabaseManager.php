<?php

namespace Src\Loading\DbHandle;

use Src\Loading\DbHandle\TableOperations;
use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseManager
{
    public function __construct()
    {
        $this->ops = new TableOperations();
    }

    public function createAllTables(array $classes)
    {
        foreach($classes as $class) {
            $this->ops->createTables($class);
        }
    }

    public function updateAllTables(array $classes)
    {
        foreach($classes as $class) {
            $this->ops->updateTables($class);
        }
    }

    public function wipeAllTables(array $classes)
    {
        foreach($classes as $class) {
            $this->ops->wipeTables($class);
        }
    }

    public function dropAllTables(array $classes)
    {
        foreach($classes as $class) {
            $this->ops->dropTables($class);
        }
    }
}