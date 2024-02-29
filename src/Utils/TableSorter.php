<?php

namespace Src\Utils;

use Src\Utils\BuilderUtils;

class TableSorter
{
    public static function sort(array $tables)
    {
        $tablesOrder = self::tablesCreationTopologicalSort();

        usort($tables, function ($a, $b) use ($tablesOrder) {
            $index_a = array_search($a['tableName'], $tablesOrder);
            $index_b = array_search($b['tableName'], $tablesOrder);
            return $index_a - $index_b;
        });

        return $tables;
    }

    private static function tablesCreationTopologicalSort()
    {
        $tables = BuilderUtils::getAllETLTablesInfo();
        $tablesDependencies = self::getTablesDependencies($tables);
        $sortedTables = [];
        $visited = [];

        foreach ($tablesDependencies as $tableName => $dependencies) {
            if (!isset($visited[$tableName])) {
                self::depthFirstSearch($tableName, $tablesDependencies, $visited, $sortedTables);
            }
        }

        return $sortedTables;
    }

    private static function getTablesDependencies(array $tables)
    {
        $tablesDependencies = [];

        foreach ($tables as $table) {
            $name = $table['tableName'];
            $dependencies = array_column($table['foreign'], 'on');
            $tablesDependencies[$name] = $dependencies;
        }

        return $tablesDependencies;
    }

    private static function depthFirstSearch($table, $tablesDependencies, &$visited, &$sortedTables)
    {
        $visited[$table] = true;
        foreach ($tablesDependencies[$table] as $dependency) {
            if (!isset($visited[$dependency])) {
                self::depthFirstSearch($dependency, $tablesDependencies, $visited, $sortedTables);
            }
        }
        $sortedTables[] = $table;
    }
}
