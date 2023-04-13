<?php

namespace Src\Loading\Scripts;

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Loading\Scripts\DatabaseBuilder;

class Transactions
{
    public static function recreateAndOrUpdateTables(array $schemas, array $ops)
    {
        try {
            $bob = new DatabaseBuilder;
            Capsule::transaction(function() use ($bob, $schemas, $ops) {
                $bob->dropAllTables($schemas);
                $bob->createAllTables($schemas);
                $bob->updateAllTables($ops);
            });
        } catch(Exception $e) {
            echo "Caught exception: ",  $e->getMessage(), "\n";
        };
        
    }

    public static function wipeDB()
    {
        try {
            Capsule::transaction(function() {
                Capsule::statement("SET FOREIGN_KEY_CHECKS = 0");
                $tables = Capsule::select('SHOW TABLES');
                foreach($tables as $table){
                    Capsule::schema()->drop($table->{'Tables_in_' . $_ENV['DB_DATABASE']});
                }
                Capsule::statement("SET FOREIGN_KEY_CHECKS = 1");
            });
        } catch(Exception $e) {
            echo "Caught exception: ",  $e->getMessage(), "\n";
        };
        
    }
}