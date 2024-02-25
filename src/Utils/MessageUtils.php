<?php

namespace Src\Utils;

class MessageUtils
{
    const ERROR_EMPTY_DB = "\n" . 
        "Error: it seems your database is empty.\n" .
        "Please make sure to use the `builder.php` script first.\n\n";

    const ERROR_TABLE_ISSUE = "\n" . 
        "Error: it seems there is an issue with your database setup. " .
        "It may be outdated.\n" .
        "Please try rebuilding it using the `builder.php` script.\n\n";

    const NECESSARY_REBUILD_MSG = "" .
        "It seems that your database is missing some table(s) or column(s).\n" .
        "Rebuilding is required.\n\n";

    const OFFER_REBUILD_MSG = "\n" .
        "It looks like you already have all the tables you need.\n" .
        "Do you want to rebuild your database? (Y/N): ";

    const EITHER_YES_NO = "" .
        "Please enter either 'Y' or 'N': ";

    const DB_CONNECTION_TIMEOUT = "\n\n\n" .
        "An error occurred: Connection timed out.\n";

    const EXITING_SCRIPT = "" .
        "Exiting the script...\n\n";

    const WIPING_DB = "\n\n" .
        "Wiping database...\n\n\n" .
        self::RULE_LINE . "\n\n\n";

    const RULE_LINE = "" .
        "-------------------" .
        "-------------------" .
        "-------------------";

    const SPACING_LINES = "\n\n" . 
        self::RULE_LINE . "\n\n\n";


    public static function eol(int $n)
    {
        echo str_repeat(PHP_EOL, $n);
    }

    public static function generatingTempTable(int $total)
    {
        echo "\nGenerating {$total} temp table(s):\n";
    }

    public static function exceptionCaught(string $errorMessage, int $eols = 2)
    {
        echo str_repeat(PHP_EOL, $eols);
        echo "Caught Exception: ";
        echo $errorMessage;
        echo self::eol(2);
    }
}