<?php

namespace Src\Utils;

class CommonUtils
{
    public static function renderLoadingBar($progress, $total)
    {
        $barLength = 50;
        $filledLength = ceil($progress / $total * $barLength);
        $emptyLength = $barLength - $filledLength;

        $filledBar = str_repeat('▇', $filledLength);
        $emptyBar = str_repeat('_', $emptyLength);
    
        $bar = $filledBar . $emptyBar;
    
        $percentage = round(($progress / $total) * 100);
    
        echo "\r[{$bar}] {$percentage}% ";

        flush();
    }

    public static function timer(callable $callback, bool $isLastTimer = False)
    {
        $start = microtime(true);
        $callback();
        $end = microtime(true);

        $timeDiff = round($end - $start);
        $minutes = floor($timeDiff / 60);
        $seconds = $timeDiff % 60;
        $isodate = sprintf("%02dm%02ds", $minutes, $seconds);
        
        if ($isLastTimer) {
            $text = "Total <{$_SERVER['PHP_SELF']}> runtime: {$isodate}";
            self::prettyPrint([$text]);

            return;
        };

        echo str_repeat(" ", 5) . "Runtime: {$isodate}" . PHP_EOL;
    }

    public static function prettyPrint(array $texts)
    {
        $mbStrlens = array_map('mb_strlen', $texts);
        $length = max($mbStrlens);

        $paddingLen = 4;
        $horizontalLine = str_repeat("═", $length + $paddingLen);
        $padding = str_repeat(" ", $paddingLen / 2);

        echo "╔" . $horizontalLine . "╗" . PHP_EOL;

        foreach($texts as $text) {
            echo "║" . $padding . str_pad($text, $length) . $padding . "║" . PHP_EOL;
        }

        echo "╚" . $horizontalLine . "╝" . PHP_EOL . PHP_EOL . PHP_EOL;
    }

    public static function printTruncatedError(string $errorMessage)
    {
        $maxCharacters = 500;

        if (strlen($errorMessage) > 2 * $maxCharacters) {
            $trimmedMessage = substr($errorMessage, 0, $maxCharacters) . "...\n..." . substr($errorMessage, - $maxCharacters);
        } else {
            $trimmedMessage = $errorMessage;
        }

        echo $trimmedMessage;
    }

    public static function cleanInput($input, array $options = [])
    {
        if (in_array("decode_html", $options)) {
            $input = html_entity_decode($input, ENT_QUOTES, 'UTF-8');
            $input = strip_tags($input);
        }

        if (in_array("trim_quotes", $options)) {
            if (substr_count($input, '"') == 1) {
                $input = str_replace('"', '', $input);
            }
            $input = preg_replace('/^"([^"]*)"$/', '$1', $input);
        }

        if (in_array("remove_trailing_periods", $options)) {
            if(substr($input, -3) !== '...' && substr($input, -3) !== '.C.') {
                $input = rtrim($input, '.');
            }
        }

        if (in_array("to_uppercase", $options)) {
            $input = mb_strtoupper($input);
        }

        $cleaningRules = [
            '/ /' => ' ',
            '/ /' => ' ',
            '/\s+/' => ' ',
        ];

        foreach ($cleaningRules as $pattern => $replacement) {
            $input = preg_replace($pattern, $replacement, $input);
        }

        return !empty($input) ? trim($input) : null;
    }
}