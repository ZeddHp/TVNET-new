<?php declare(strict_types=1);

use ArticlesApp\Console\Router;

require_once __DIR__ . '/vendor/autoload.php';

$resource = $argv[1] ?? null;
$ids = array_slice($argv, 2) ?? null;

Router::response($resource, $ids);