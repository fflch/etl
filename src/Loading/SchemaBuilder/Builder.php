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

            $primary = $tableProps['primary'];
            if(!empty($primary)){
                if(array_key_exists('keyName', $primary)){
                    $table->primary($primary['key'], $primary['keyName']);
                }
                else{
                    $table->primary($primary['key']);
                }
            }

            if(!empty($tableProps['foreign'])){
                foreach($tableProps['foreign'] as $foreign) {
                    $constraintName = $foreign['constraintName'] ?? null;
                    $table->foreign($foreign['keys'], $constraintName)
                        ->references($foreign['references'])
                        ->on($foreign['on'])
                        ->onDelete($foreign['onDelete']);
                }
            }
        });
    }

    public function dropTable(array $tableProps)
    {
        Capsule::schema()->dropIfExists($tableProps['tableName']);
    }
}