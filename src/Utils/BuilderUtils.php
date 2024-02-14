<?php

namespace Src\Utils;

require_once __DIR__ . "/../../vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Loading\DbHandle\DatabaseManager;

use Src\Loading\SchemaBuilder\Schemas\PessoasSchemas;
use Src\Loading\SchemaBuilder\Schemas\GraduacaoSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGraduacaoSchemas;
use Src\Loading\SchemaBuilder\Schemas\PesquisasAvancadasSchemas;
use Src\Loading\SchemaBuilder\Schemas\CEUSchemas;
use Src\Loading\SchemaBuilder\Schemas\ServidoresSchemas;
use Src\Loading\SchemaBuilder\Schemas\ProgramasUSPSchemas;
use Src\Loading\SchemaBuilder\Schemas\LattesSchemas;

class BuilderUtils
{
    public static function getAllSchemasClasses()
    {
        return [
            PessoasSchemas::class,
            GraduacaoSchemas::class,
            PosGraduacaoSchemas::class,
            PesquisasAvancadasSchemas::class,
            CEUSchemas::class,
            ServidoresSchemas::class,
            ProgramasUSPSchemas::class,
            LattesSchemas::class,
        ];
    }

    public static function getTablesNamesFromSchemasClasses(array $classes)
    {
        $tablesNames = [];
        $tablesProperties = self::getTablesInfoFromSchemasClasses($classes);
        
        foreach ($tablesProperties as $tableProperties) {
            $tablesNames[] = $tableProperties['tableName'];
        }

        return $tablesNames;

    }

    public static function getTablesInfoFromSchemasClasses(array $classes)
    {
        $tables = [];

        foreach ($classes as $class) {
            $refl = new \ReflectionClass($class);
            $tables = array_merge($tables, $refl->getConstants());
        }

        return $tables;
    }

    public static function getAllETLTablesInfo()
    {
        $allClasses = self::getAllSchemasClasses();
        return self::getTablesInfoFromSchemasClasses($allClasses);
    }

    public static function getAllETLTablesNames()
    {
        $allClasses = self::getAllSchemasClasses();   
        return self::getTablesNamesFromSchemasClasses($allClasses);
    }

    public static function validateCurrentDatabaseStructure(bool $isTryingToLoad)
    {
        $expectedUserSchemas = self::getAllETLTablesNames();
        $actualUserSchemas = self::getUserSchemas();

        $isMissingSchemas = !empty(array_diff($expectedUserSchemas, $actualUserSchemas));

        if ($isMissingSchemas && $isTryingToLoad) {
            $errorMessage = PHP_EOL;
            $errorMessage .= "Error: your database seems to be outdated. ";
            $errorMessage .= PHP_EOL;
            $errorMessage .= "Please try rebuilding it using the `builder.php` script.";
            $errorMessage .= PHP_EOL . PHP_EOL;
            die($errorMessage);
        }

        return $isMissingSchemas;
    }

    public static function setupDatabase()
    {
        $requestingRebuild = null;
        $isMissingSchemas = self::validateCurrentDatabaseStructure(false);

        if ($isMissingSchemas === false) {
            $requestingRebuild = self::offerRebuild();
        }

        $decision = self::buildDecision(
            $isMissingSchemas,
            $requestingRebuild
        );

        self::buildMessage($decision);
        return self::buildAction($decision);
    }

    private static function offerRebuild()
    {
        echo PHP_EOL . "It looks like you already have all the tables you need." .
            PHP_EOL . "Do you want to rebuild your database? (Y/N): ";

        $response = strtoupper(trim(fgets(STDIN)));

        while (true) {
            if ($response === 'Y') {
                return true;
            } elseif ($response === 'N') {
                return false;
            } else {
                echo "Please enter either 'Y' or 'N': ";
            }
        }
    }

    private static function buildDecision($missingSchemas, $requestingRebuild)
    {
        if (count(self::getUserSchemas()) == 0) {
            return 'first build';
        }
        if ($missingSchemas) {
            return 'necessary rebuild';
        }
        if ($requestingRebuild) {
            return 'optional rebuild';
        } else {
            echo PHP_EOL;
            die();
        }
    }

    private static function buildMessage($decision)
    {
        echo PHP_EOL;

        switch ($decision) {
            case "necessary rebuild":
                echo "It seems that your database is missing some table(s)." . PHP_EOL;
                echo "Rebuilding is required." . PHP_EOL . PHP_EOL . PHP_EOL;
                break;
        }

        return;
    }

    private static function buildAction($decision)
    {
        $schemasClasses = self::getAllSchemasClasses();
        $dbManager = new DatabaseManager();

        if ($decision === 'first build') {
            $dbManager->buildDB($schemasClasses);
            return true;
        }
        if (strpos($decision, 'rebuild')) {
            $dbManager->rebuildDB($schemasClasses);
            return true;
        } else {
            return false;
        }
    }

    private static function getUserSchemas()
    {
        $tables = Capsule::schema()->getAllTables();

        if (empty($tables)) {
            return [];
        }

        $tableNames = [];
        foreach ($tables as $table) {
            $tableNames[] = $table->{"Tables_in_" . $_ENV['DB_DATABASE']};
        }

        return $tableNames;
    }
}
