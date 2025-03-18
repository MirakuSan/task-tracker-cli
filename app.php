#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use App\Application;

try {
    $app = new Application();
    $app->run();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    exit(1);
} 
