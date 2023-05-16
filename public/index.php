<?php declare(strict_types=1);

use ArticlesApp\Core\Router;
use ArticlesApp\Core\Renderer;

require_once __DIR__ . '/../vendor/autoload.php';

$routes = require_once '../routes.php';

$response = Router::response($routes);
$renderer = new Renderer();

//var_dump($response);die();

echo $renderer->render($response);