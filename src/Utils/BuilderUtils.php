<?php

namespace Src\Utils;

require_once __DIR__ . "/../../vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Loading\DbHandle\DatabaseManager;
use Src\Utils\TableSorter;

class BuilderUtils
{
    public static function getAllTableGroups()
    {
        return [
            'PessoasTables',
            'GraduacaoTables',
            'PosGraduacaoTables',
            'PesquisasAvancadasTables',
            'CEUTables',
            'ServidoresTables',
            'ProgramasUSPTables',
            'QuestSocioEconTables',
            'LattesTables',
        ];
    }

    public static function getTablesNamesFromTableGroups(
        array $groups,
        bool $sortedByDependencies = false
    ) {
        $tablesNames = [];

        $tablesProperties = self::getTablesInfoFromTableGroups($groups, $sortedByDependencies);

        foreach ($tablesProperties as $tableProperties) {
            $tablesNames[] = $tableProperties['tableName'];
        }

        return $tablesNames;
    }

    public static function getTableGroupPath(string $groupName)
    {
        return __DIR__ . "/../Loading/SchemaBuilder/Tables/" . $groupName;
    }

    public static function getTablesInfoFromTableGroups(
        array $groups,
        bool $sortedByDependencies = false
    ) {
        $tablesInfo = [];

        foreach ($groups as $group) {
            $groupPath = self::getTableGroupPath($group);
            $files = glob("$groupPath/*.php");
            foreach ($files as $file) {
                $content = include $file;
                $tablesInfo[] = $content;
            }
        }

        if ($sortedByDependencies) {
            return TableSorter::sort($tablesInfo);
        }

        return $tablesInfo;
    }

    public static function getAllETLTablesInfo(bool $sortedByDependencies = false)
    {
        $allGroups = self::getAllTableGroups();
        return self::getTablesInfoFromTableGroups($allGroups, $sortedByDependencies);
    }

    public static function validateCurrentDatabaseStructure(bool $isTryingToLoad)
    {
        $expectedUserTablesColumns = self::getExpectedTablesColumns();
        $actualUserTables = Capsule::schema()->getAllTables();
        $missingColumnFound = false;

        foreach ($expectedUserTablesColumns as $table => $columns) {
            if(!Capsule::schema()->hasColumns($table, $columns)) {
                $missingColumnFound = true;
            };
        }

        if ($isTryingToLoad) {
            if (empty($actualUserTables)) {
                die(MessageUtils::ERROR_EMPTY_DB);
            }
            elseif ($missingColumnFound) {
                die(MessageUtils::ERROR_TABLE_ISSUE);
            }
            else {
                return;
            }
        }

        return $missingColumnFound;
    }

    public static function setupDatabase()
    {
        $requestingRebuild = false;
        $missingColumnFound = self::validateCurrentDatabaseStructure(false);

        if ($missingColumnFound === false) {
            $requestingRebuild = self::offerRebuild();
        }

        $decision = self::buildDecision(
            $missingColumnFound,
            $requestingRebuild
        );

        self::buildMessage($decision);
        return self::buildAction($decision);
    }

    private static function offerRebuild()
    {
        echo MessageUtils::OFFER_REBUILD_MSG;

        $response = strtoupper(trim(fgets(STDIN)));

        while (true) {
            if ($response === 'Y') {
                return true;
            } elseif ($response === 'N') {
                return false;
            } else {
                echo MessageUtils::EITHER_YES_NO;
                $response = strtoupper(trim(fgets(STDIN)));
            }
        }
    }

    private static function buildDecision(bool $missingColumnFound, bool $requestingRebuild)
    {
        if (empty(Capsule::schema()->getAllTables())) {
            return 'first build';
        } elseif ($missingColumnFound) {
            return 'necessary rebuild';
        } elseif ($requestingRebuild) {
            return 'optional rebuild';
        } else {
            echo MessageUtils::eol(1);
            die();
        }
    }

    private static function buildMessage(string $decision)
    {
        echo MessageUtils::eol(1);

        switch ($decision) {
            case "necessary rebuild":
                echo MessageUtils::NECESSARY_REBUILD_MSG;
                break;
        }

        return;
    }

    private static function buildAction(string $decision)
    {
        $tableGroups = self::getAllTableGroups();
        $dbManager = new DatabaseManager();

        if ($decision === 'first build') {
            $dbManager->buildDB($tableGroups);
            return true;
        }
        if (strpos($decision, 'rebuild')) {
            $dbManager->rebuildDB($tableGroups);
            return true;
        } else {
            return false;
        }
    }

    private static function getExpectedTablesColumns()
    {
        $expectedUserTablesColumns = [];
        $allTablesInfo = self::getAllETLTablesInfo();

        foreach($allTablesInfo as $tableInfo) {
            $tableName = $tableInfo["tableName"];
            $tableColumns = array_keys($tableInfo["columns"]);
            // hotfix
            $tableColumns = array_diff($tableColumns, [""]);
            $expectedUserTablesColumns[$tableName] = $tableColumns;
        }

        return $expectedUserTablesColumns;
    }
}
