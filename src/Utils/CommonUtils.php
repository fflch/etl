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

    public static function timer(callable $callback, string $final = null)
    {
        $start = microtime(true);
        $callback();
        $end = microtime(true);

        $timeDiff = round($end - $start);
        $minutes = floor($timeDiff / 60);
        $seconds = $timeDiff % 60;
        $isodate = sprintf("%02dm%02ds", $minutes, $seconds);
        
        if ($final === 'final') {
            $text = "Total <{$_SERVER['PHP_SELF']}> runtime: {$isodate}";
            $length = strlen($text) + 4;

            echo PHP_EOL;
            echo "╔" . str_repeat("═", $length) . "╗\n";
            echo "║  {$text}  ║\n";
            echo "╚" . str_repeat("═", $length) . "╝\n";
            echo PHP_EOL . PHP_EOL;

            return;
        };

        echo str_repeat(" ", 5) . "Runtime: {$isodate}";
    }
}