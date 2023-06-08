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
            $length = mb_strlen($text);
            $paddingLen = 4;
            $horizontalLine = str_repeat("═", $length + $paddingLen);
            $padding = str_repeat(" ", $paddingLen / 2);

            echo PHP_EOL;
            echo "╔" . $horizontalLine . "╗" . PHP_EOL;
            echo "║" . $padding . $text . $padding . "║" . PHP_EOL;
            echo "╚" . $horizontalLine . "╝" . PHP_EOL;
            echo PHP_EOL . PHP_EOL;

            return;
        };

        echo str_repeat(" ", 5) . "Runtime: {$isodate}";
    }
}