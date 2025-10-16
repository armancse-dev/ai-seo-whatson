<?php
foreach (glob(__DIR__.'/config/*.php') as $f) {
    echo "Checking ".basename($f)." ... ";
    try {
        $config = include $f;
        if (!is_array($config)) {
            throw new Exception('Config must return an array, returned '.gettype($config));
        }
        echo "✅ OK\n";
    } catch (Throwable $e) {
        echo "❌ ".$e->getMessage()."\n";
    }
}
