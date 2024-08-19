<?php

namespace Src\Loading\DbHandle;

use Src\Loading\DbHandle\DatabaseHelper;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\CommonUtils;
use Src\Utils\MessageUtils;

class DatabaseManager
{
    private $dbHelper;

    public function __construct()
    {
        $this->dbHelper = new DatabaseHelper();
    }

    public function loadOrReloadTables(array $tableGroups, array $notToWipe = [])
    {
        try {
            Capsule::transaction(function () use ($tableGroups, $notToWipe) {

                $tablesGroupsToWipe = array_diff($tableGroups, $notToWipe);

                if (!empty($tablesGroupsToWipe)) {
                    CommonUtils::timer(function () use ($tablesGroupsToWipe) {
                        $this->dbHelper->WipeTables($tablesGroupsToWipe);
                    });
                    echo MessageUtils::eol(1);
                }

                CommonUtils::timer(function () use ($tableGroups) {
                    $this->dbHelper->updateTables($tableGroups);
                });

                echo MessageUtils::eol(2);
            });
        } catch (\Exception $e) {
            echo MessageUtils::exceptionCaught($e, 2);
            echo MessageUtils::EXITING_SCRIPT;
            exit();
        }
    }

    public function rebuildDB()
    {
        $this->nukeDB();
        $this->buildDB();
    }

    public function buildDB()
    {
        CommonUtils::timer(function () {
            $this->dbHelper->createTables();
        });

        echo MessageUtils::SPACING_LINES;
    }

    public function nukeDB()
    {
        CommonUtils::timer(function () {
            $this->dbHelper->dropTables();
        });

        echo MessageUtils::eol(1);
    }
}
