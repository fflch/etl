<?php

namespace Src\Loading\DbHandle;

use Src\Loading\DbHandle\DatabaseManager;
use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseTasks
{
    public function __construct()
    {
        $this->dbManager = new DatabaseManager();
    }

    public function wipeAndOrUpdateTables(array $schemas, array $ops)
    {
        Capsule::transaction(function() use ($schemas, $ops) {
            $this->dbManager->wipeAllTables($schemas);
            $this->dbManager->updateAllTables($ops);
        });
    }

    public function rebuild($classes)
    {
        Capsule::statement("SET FOREIGN_KEY_CHECKS = 0");
        $this->dbManager->dropAllTables($classes);
        Capsule::statement("SET FOREIGN_KEY_CHECKS = 1");
        $this->dbManager->createAllTables($classes);
    }
}
