<?php

namespace Src\Loading\Scripts;

use Src\Loading\Scripts\TablesMethods;
use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseBuilder
{
    public function __construct()
    {
        $this->wizard = new TablesMethods();
    }

    public function dropAllTables(array $classes)
    {
        Capsule::schema()->disableForeignKeyConstraints(); //gambi

        foreach($classes as $class) {
            $this->wizard->dropTables($class);
        }
        
        Capsule::schema()->enableForeignKeyConstraints();
    }

    public function createAllTables(array $classes)
    {
        foreach($classes as $class) {
            $this->wizard->createTables($class);
        }
    }

    public function updateAllTables(array $classes)
    {
        foreach($classes as $class) {
            $this->wizard->updateTables($class);
        }
    }
}