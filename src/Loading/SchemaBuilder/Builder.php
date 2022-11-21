<?php

namespace Src\Loading\SchemaBuilder;

require __DIR__ . "/../../../vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

class Builder
{

    public function createTable(array $tableProps)
    {
        Capsule::schema()->create($tableProps['tableName'], function ($table) use ($tableProps) {
            foreach($tableProps['columns'] as $name => $attr) {

                $type = $attr['type'];

                if(array_key_exists('size', $attr)){
                    array_key_exists('nullable', $attr)
                    ? $table->$type($name, $attr['size'])->nullable()
                    : $table->$type($name, $attr['size']);
                }
                else{
                    array_key_exists('nullable', $attr)
                    ? $table->$type($name)->nullable()
                    : $table->$type($name);
                }
            }

            if(!empty($tableProps['primary'])){
                $table->primary($tableProps['primary']);
            }

            if(!empty($tableProps['foreign'])){
                foreach($tableProps['foreign'] as $foreign) {
                    $table->foreign($foreign['keys'])
                        ->references($foreign['references'])
                        ->on($foreign['on'])
                        ->onDelete($foreign['onDelete']);
                }
            }
        });
    }

    public function dropTable(array $tableProps)
    {
        Capsule::schema()->disableForeignKeyConstraints(); //gambi
        Capsule::schema()->dropIfExists($tableProps['tableName']);
        Capsule::schema()->enableForeignKeyConstraints();
    }
}